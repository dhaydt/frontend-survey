<div class="">
    @props([
            'question',
            'name',
            'required',
            'hint',
            'image',
            'audio',
            'no'
        ])
    <label for="exampleInputEmail1" class="form-label {{ $required == 1 ? 'required' : '' }}">{{ $no }}. {{ $question ?? '' }}</label>

    @if ($image)
    <div class="d-block img-question">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <img src="{{ asset($image) }}" alt="image_{{ $question }}">
            </div>
        </div>
    </div>
    @endif

    @if ($audio)
    <div class="d-block img-question">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <audio controls autoplay>
                    <source src="{{ asset($audio) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    </div>
    @endif

    <textarea type="text" placeholder="Jawaban" name="{{ $name }}" wire:model.live="answers.{{ $name }}" class="form-control ms-2" id="{{ $name }}" {{ $required == 1 ? 'required' : '' }}>

    </textarea>
    @if ($hint !== null && $hint !== "")
    <div id="{{ $name }}" class="form-text ms-2">{{ $hint }}</div>
    @endif
    @error('answers.'.$name)
        <small class="text-danger ms-2">{{ $message }}</small>
    @enderror
</div>
