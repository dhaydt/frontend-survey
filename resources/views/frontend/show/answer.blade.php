@extends('frontend.layouts.app')

@section('content')
<style>
    .jwb-img{
        max-width: 60%;
        height: auto;
    }

    @media(max-width : 600px){
        .jwb-img{
            max-width: 100%;
            height: auto;
        }
    }
</style>
<div class="contaier">

    <div>
        <div class="">

            <div class="card card-body shadow-sm stepper">
                <x-survey-header name="{{ $survey['name'] }}" description="{{ $survey['description'] }}"></x-survey-header>

                <div class="header-hr"></div>

                <div class="ms-22">
                    <h6 class="second-color italic text-uppercase">
                        {{ $answer['name'] }} ({{ $answer['phone'] }})
                    </h6>
                </div>
                @if($answer['location'] != NULL)
                <div class="ms-22">
                    <span class="second-color italic text-capitalize">
                        @if($answer['location']['display'] !== null)
                        {{ $answer['location']['display'] }}
                        @else
                        {{ $answer['location']['district'] }} - {{ $answer['location']['city'] ?? $answer['location']['kabupaten'] }}, ({{ $answer['location']['region'] }}), {{ $answer['location']['country'] }} - {{ $answer['location']['postcode'] }}
                        @endif
                    </span>
                </div>
                @endif
                @if(!empty($successMessage))
                <div class="alert alert-success">
                    {{ $successMessage }}
                </div>
                @endif
            </div>

            <div class="row setup-content px-5">
                <div class="col-xs-12">
                    <div class="col-md-12 pt-2">
                        @foreach ($answer['answers'] as $k => $a)
                            <div class="card card-body mb-2 shadow-sm">
                                <span class="text-capitalize">
                                    {{ $k+1 }}. {{ $a['question'] }}
                                </span>

                                <div class="card p-2 mt-2">
                                    <span>Jawaban :</span>
                                    <hr class="my-1">
                                    @if(is_array($a['answer']))
                                        @foreach ($a['answer'] as $s)
                                            @if(is_array($s))
                                            <div class="row ms-4">
                                                <div class="col-md-4">
                                                    <span class="text-capitalize fw-bold">
                                                        {{ $s['parameter'] }}
                                                    </span>
                                                </div>
                                                <div class="col-md-8">
                                                    :<span class="badge bg-success ms-3">{{ $s['answer'] }}</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-md-2 ms-4">
                                                <span class="badge bg-success text-capitalize">{{ $s }}</span>
                                            </div>
                                            @endif
                                        @endforeach
                                    @else
                                        @if(strtotime($a['answer']) != null)
                                            <span class="ms-4">{{ \Carbon\Carbon::parse($a['answer'])->format('d-m-Y H:i') }}</span>
                                        @else
                                            @if(isset($a['type']))
                                                @if($a['type'] == 'image')
                                                    <div class="d-flex justify-content-center">
                                                        <img src="{{ asset($a['answer']) }}" class="jwb-img" style="" alt="jawaban-image">
                                                    </div>
                                                @elseif($a['type'] == 'pdf')
                                                    <a href="{{ asset($a['answer']) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-download me-2"></i>
                                                        Download Jawaban
                                                    </a>
                                                @endif
                                            @else
                                                <span class="ms-4 text-capitalize">{{ $a['answer'] }}</span>
                                            @endif
                                            @if(isset($a['reason']))
                                            <hr class="my-1">
                                            <div class="d-flex">
                                                <span class="text-capitalize">Alasan :</span>
                                            </div>
                                            <hr class="my-1">
                                            <span class="ms-4 text-capitalize">{{ $a['reason'] }}</span>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        Livewire.on('scroll-top', function(){
            window.scrollTo(0, 0);
        })
    </script>
    @endpush

</div>
@endsection
