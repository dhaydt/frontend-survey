<?php

namespace App\Livewire\Frontend;

use App\CPU\Helpers;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\Survey;
use App\Models\Verify;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public $currentStep = 1;

    public $successMessage = '';

    public $survey;
    public $questions;
    public $answers = [];
    public $reason = [];

    public $name;
    public $phone;

    public $type;
    public $need_location = 0;

    public $receivedCode;
    public $isVerified = 0;

    public $timer = 0;

    public $city;
    public $county;
    public $postcode;
    public $negara;
    public $pulau;
    public $kelurahan;
    public $latitude;
    public $longitude;
    public $displayname;
    public $surveyor_id;

    public function verifyNumber()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'type' => 'required',
        ], [
            'name.required' => 'Masukan nama anda',
            'phone.required' => 'Masukan nomor handphone anda',
            'type.required' => 'Pilih metode verifikasi'
        ]);

        $code = random_int(100000, 999999);

        $duplicate = Verify::where('code', $code)->first();

        if ($duplicate) {

            $code = random_int(100000, 999999);
        }

        $data = [
            'phone' => $this->phone,
            'code' => $code
        ];


        if ($this->type == 'message') {
            Helpers::sendMessage($data);
        } else {
            Helpers::sendWa($data);
        }

        $this->timer = 1;

        $this->dispatch('countdown');
    }

    public function postCode()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'type' => 'required',
            'receivedCode' => 'required',
        ], [
            'name.required' => 'Masukan nama anda',
            'phone.required' => 'Masukan nomor handphone anda',
            'type.required' => 'Pilih metode verifikasi',
            'receivedCode.required' => 'Masukan kode verifikasi yang dikirimkan ke handphone anda',
        ]);

        // dd('called');
        $check = Verify::where('code', $this->receivedCode)->first();
        if($check){
            $this->isVerified = 1;

            $this->dispatch('user_verified');

            $collectAnswers = [];

            foreach($this->answers as $k => $a){
                $q = Question::find($k);

                if(isset($q['input']['name'])){
                    if($q['input']['name'] == 'Text' || $q['input']['name'] == 'Number' || $q['input']['name'] == 'Date Time' || $q['input']['name'] == 'Select One'  || $q['input']['name'] == 'Select Many'){

                        if($q['input']['name'] == 'Select One'){
                            $item = [
                                'question_id' => $k,
                                'question' => $q['question'],
                                'answer' => $a,
                                'reason' => $this->reason[$k] ?? NULL
                            ];
                        }else{
                            $item = [
                                'question_id' => $k,
                                'question' => $q['question'],
                                'answer' => $a,
                            ];
                        }

                        array_push($collectAnswers, $item);
                    }

                    if($q['input']['name'] == 'Image'){
                        $dir = 'answers/';
                        $ext = $a['file']->getClientOriginalExtension();
                        $imageName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . $ext;
                        $a['file']->storeAs('public/' . $dir, $imageName);

                        $img_name = 'storage/' . $dir . $imageName;

                        $item = [
                            'question_id' => $k,
                            'question' => $q['question'],
                            'type' => 'image',
                            'answer' => $img_name
                        ];

                        array_push($collectAnswers, $item);
                    }

                    if($q['input']['name'] == 'File Doc & PDF'){
                        $dir = 'answers/';
                        $ext = $a['file']->getClientOriginalExtension();
                        $imageName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . $ext;
                        $a['file']->storeAs('public/' . $dir, $imageName);

                        $img_name = 'storage/' . $dir . $imageName;

                        $item = [
                            'question_id' => $k,
                            'question' => $q['question'],
                            'type' => 'pdf',
                            'answer' => $img_name
                        ];

                        array_push($collectAnswers, $item);
                    }

                    if($q['input']['name'] == 'Ranking'){
                        $subItem = [];

                        foreach ($q['ranking'] as $key => $r) {
                            $sub = [
                                'parameter' => $r['question'],
                                'answer' => $a[$key] ?? '-'
                            ];
                            array_push($subItem, $sub);
                        }

                        $item = [
                            'question_id' => $k,
                            'question' => $q['question'],
                            'answer' => $subItem
                        ];

                        array_push($collectAnswers, $item);
                    }

                    if($q['input']['name'] == 'Matrik'){
                        $subItem2 = [];

                        foreach ($q['matriks'] as $ky => $ma) {
                            // dd($ma, $ky);
                            $sub = [
                                'parameter' => $ma['question'],
                                'answer' => $a[$ky] ?? ""
                            ];
                            array_push($subItem2, $sub);
                        }

                        $item = [
                            'question_id' => $k,
                            'question' => $q['question'],
                            'answer' => $subItem2
                        ];

                        array_push($collectAnswers, $item);
                    }
                }
            }

            if($this->need_location == 1){
                $location = [
                    "lat" => $this->latitude,
                    "lng" => $this->longitude,
                    "city" => $this->city,
                    "kabupaten" => $this->county,
                    "postcode" => $this->postcode,
                    "country" => $this->negara,
                    "region" => $this->pulau,
                    "surveyor_id" => $this->surveyor_id ?? NULL,
                    "district" => $this->kelurahan,
                    "display" => $this->displayname,
                ];
            }else{
                $location = NULL;
            }

            $save = new QuestionAnswer();
            $save->name = $this->name;
            $save->survey_id = $this->survey['id'];
            $save->phone = $this->phone;
            $save->answers = $collectAnswers;
            $save->location = $location;
            $save->save();

            $this->secondStepSubmit();
        }else{
            $this->addError('receivedCode', 'Kode verifikasi tidak sesuai');
        }
    }

    public function firstStepSubmit()
    {
        $this->dispatch('scroll-top');
        foreach ($this->questions as $key => $q) {
                if ($q['need_reason']) {
                    if ($q['need_reason']['status'] == true) {
                        if($this->answers[$q['id']] == $q['need_reason']['option']){
                            $this->validate([
                                'reason.'.$q['id'] => 'required'
                            ], [
                                'reason.'.$q['id'].'.required' => 'Masukan alasan anda jika menjawab '.$q['need_reason']['option']
                            ]);
                        }
                    }

                }

                if($q['is_required']){
                    if(isset($q['input']['name'])){
                    if($q['input']['name'] == 'Text' || $q['input']['name'] == 'Number' || $q['input']['name'] == 'Date Time'){
                        $this->validate([
                            'answers.'.$q['id'] => 'required'
                        ], [
                            'answers.'.$q['id'].'.required' => 'Jawaban pertanyaan ini wajib di isi'
                        ]);
                    }

                    if($q['input']['name'] == 'Ranking'){
                        foreach($q['ranking'] as $k => $r){
                            $this->validate([
                                'answers.'.$q['id'].'.'.$k => 'required'
                            ], [
                                'answers.'.$q['id'].'.'.$k.'.required' => 'Ranking ini Wajib di pilih!'
                            ]);
                        }
                    }

                    if($q['input']['name'] == 'Matrik'){
                        foreach($q['matriks'] as $k => $r){
                            $this->validate([
                                'answers.'.$q['id'].'.'.$k => 'required'
                            ], [
                                'answers.'.$q['id'].'.'.$k.'.required' => 'Matrik ini Wajib di pilih!'
                            ]);
                        }
                    }

                    if($q['input']['name'] == 'Image' || $q['input']['name'] == 'Audio' || $q['input']['name'] == 'File Doc & PDF'){
                        $this->validate([
                            'answers.'.$q['id'].'.file' => 'required'
                        ],[
                            'answers.'.$q['id'].'.file.required' => 'Upload file ini dibutuhkan!'
                        ]);
                    }
                }
            }
        }
        // dd($this->questions, $this->answers);
        // $validatedData = $this->validate([
        //     'name' => 'required|unique:products',
        //     'amount' => 'required|numeric',
        //     'description' => 'required',
        // ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'type' => 'required',
            'receivedCode' => 'required',
        ], [
            'name.required' => 'Masukan nama anda',
            'phone.required' => 'Masukan nomor handphone anda',
            'type.required' => 'Pilih metode verifikasi',
            'receivedCode.required' => 'Masukan kode verifikasi yang dikirimkan ke handphone anda',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm()
    {
        $this->successMessage = 'Product Created Successfully.';

        $this->clearForm();

        $this->currentStep = 1;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        // $this->name = '';
        // $this->amount = '';
        // $this->description = '';
        // $this->stock = '';
        // $this->status = 1;
    }

    public function mount($id, $surveyor_id)
    {
        $this->survey = Survey::with('questions')->find($id);
        $this->questions = $this->survey->questions;
        $this->surveyor_id = $surveyor_id;

        foreach ($this->questions as $q) {
            if($q['need_location'] == 1){
                $this->need_location = 1;
            }
            if ($q['is_multiple'] == 1) {
                $this->answers[$q['id']] = [];
            } else {
                if(isset($q->input->name)){
                    if (strToLower($q->input->name) == 'matrik' || strToLower($q->input->name) == 'ranking') {
                        $this->answers[$q['id']] = [];
                    } elseif (strToLower($q->input->name) == 'image') {
                        $this->answers[$q['id']] = [
                            'type' => 'image',
                            'file' => ''
                        ];
                    } elseif (strToLower($q->input->name) == 'audio') {
                        $this->answers[$q['id']] = [
                            'type' => 'audio',
                            'file' => ''
                        ];
                    } elseif (strToLower($q->input->name) == 'file doc & pdf') {
                        $this->answers[$q['id']] = [
                            'type' => 'doc',
                            'file' => ''
                        ];
                    } else {
                        $this->answers[$q['id']] = "";
                    }
                }
            }

            if ($q['need_reason']) {
                if ($q['need_reason']['status'] == true) {
                    $this->reason[$q['id']] = "";
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.frontend.show');
    }
}
