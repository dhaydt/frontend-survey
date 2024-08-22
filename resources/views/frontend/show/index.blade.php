@extends('frontend.layouts.app')

@section('content')
<style>
    #map{
        height: 80vh;
        width: 100%
    }
</style>
<div class="container" id="question">
    @livewire('frontend.show', ['id' => $id, 'surveyor_id' => $surveyor_id ?? NULL])
</div>
@endsection
@push('js')

@endpush
