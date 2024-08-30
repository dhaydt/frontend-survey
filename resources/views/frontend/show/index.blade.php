@extends('frontend.layouts.app')

@section('content')
<style>
    #map{
        height: 80vh;
        width: 100%
    }
    @media(max-width : 600px){
        #question{
            padding: 0;
            /* overflow-x: hidden; */
        }

        .card-body{
            padding: 10px;
        }

        h4{
            font-size: 18px !important;
        }

        h6{
            font-size: 14px !important;
        }

        p{
            font-size: 12px;
        }

        .row.setup-content{
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
    }
</style>
<div class="container" id="question">
    @livewire('frontend.show', ['id' => $id, 'surveyor_id' => $surveyor_id ?? NULL])
</div>
@endsection
@push('js')

@endpush
