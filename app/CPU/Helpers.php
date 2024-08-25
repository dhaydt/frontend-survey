<?php

namespace App\CPU;

use App\Models\ApiResponse;
use App\Models\Input;
use App\Models\InputGroup;
use App\Models\Survey;
use App\Models\User;
use App\Models\Verify;
use DateTime;

class Helpers
{
    public static function backendUrl() {
        return config('app.backend_url');
    }
    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && strtolower($d->format($format)) === strtolower($date);
    }
    public static function sendWa($data){
        $zenziva = Helpers::zenzivaCredentials();

        $url = 'https://console.zenziva.net/wareguler/api/sendWA/';

        $message = 'Kode verifikasi kliksurvei anda : ' . $data['code'];

        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $zenziva['userkey'],
            'passkey' => $zenziva['passkey'],
            'to' => $data['phone'],
            'message' => $message
        ));

        Helpers::saveCode($data);

        $results = json_decode(curl_exec($curlHandle), true);

        Helpers::saveResponse('zenziva_whatsapp', $results);
    }

    public static function sendMessage($data){
        $zenziva = Helpers::zenzivaCredentials();

        $url = 'https://console.zenziva.net/reguler/api/sendsms/';

        $message = 'Kode verifikasi kliksurvei anda : ' . $data['code'];

        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $zenziva['userkey'],
            'passkey' => $zenziva['passkey'],
            'to' => $data['phone'],
            'message' => $message
        ));

        Helpers::saveCode($data);

        $results = json_decode(curl_exec($curlHandle), true);

        Helpers::saveResponse('zenziva_message', $results);
    }

    public static function saveCode($data){
        Verify::create([
            'phone' => $data['phone'],
            'code' => $data['code']
        ]);
    }

    public static function saveResponse($type, $response){
        ApiResponse::create([
            'name' => $type,
            'response' => $response
        ]);
    }

    public static function zenzivaCredentials()
    {
        $data['passkey'] = "9dcb371da06077c04eaaf4fe";
        $data['userkey'] = "89ffe4794aa1";

        return $data;
    }

    public static function getDefaultPassword()
    {
        return '12345678';
    }

    public static function generateSurveyorId()
    {
        $count = User::Surveyor()->count() + 1;

        if ($count > 9) {
            $zero = 5;
        } elseif ($count > 99) {
            $zero = 4;
        } elseif ($count > 999) {
            $zero = 3;
        } elseif ($count > 9999) {
            $zero = 2;
        } elseif ($count > 99999) {
            $zero = 1;
        } else {
            $zero = 6;
        }

        $number = str_pad($count, $zero, '0', STR_PAD_LEFT);

        return 'S' . $number;
    }

    public static function generateSurveysId()
    {
        $count = Survey::count() + 1;

        if ($count > 9) {
            $zero = 7;
        } elseif ($count > 99) {
            $zero = 6;
        } elseif ($count > 999) {
            $zero = 5;
        } elseif ($count > 9999) {
            $zero = 4;
        } elseif ($count > 99999) {
            $zero = 3;
        } elseif ($count > 999999) {
            $zero = 2;
        } elseif ($count > 9999999) {
            $zero = 1;
        } else {
            $zero = 8;
        }

        $number = str_pad($count, $zero, '0', STR_PAD_LEFT);

        if (Survey::where('surveys_id', $number)->first()) {
            $number = $number . now('His');
        }

        return $number;
    }

    public static function getMatrikOptions()
    {
        return [
            'biasa',
            'bagus',
            'sangat bagus',
        ];
    }

    public static function getRankingOptions()
    {
        return [
            1,
            2,
            3,
            4,
            5,
        ];
    }

    public static function getInputIcons()
    {
        $icons = InputGroup::orderBy('id')->pluck('icon');
        $newIcon = [''];
        foreach ($icons as $i) {
            array_push($newIcon, $i);
        }

        return $newIcon;
    }

    public static function modifyOptions($data)
    {
        dd($data);
    }
}
