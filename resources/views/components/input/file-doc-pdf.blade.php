<div class="">
    @props([
            'question',
            'name',
            'required',
            'hint',
            'image',
            'audio',
            'answers',
            'no'
        ])
    <label for="{{ $name }}" class="form-label {{ $required == 1 ? 'required' : '' }}">{{ $no }}. {{ $question ?? '' }}</label>

    <div class="upload-btn-wrapper d-block">
        <button class="btn upload w-100 mt-3">
            <i class="fa-regular fa-file mb-2"></i> <br>
            <span class="">
                UPLOAD FILE
            </span>
        </button>
        <input
            type="file"
            placeholder="Jawaban"
            name="{{ $name }}"
            wire:model.live="answers.{{ $name }}.file"
            class="form-control ms-2"
            id="{{ $name }}"
            accept=".pdf, .doc, .docx"
            {{ $required == 1 ? 'required' : '' }}
        />
    </div>

    @if ($answers[$name]['file'])
    <div class="row justify-content-center">
        File : {{ $answers[$name]['file']->getClientOriginalName() }}
    </div>
    @endif

    @if ($hint !== null && $hint !== "")
    <div id="{{ $name }}" class="form-text ms-2">{{ $hint }}</div>
    @endif

    @error('answers.'.$name.'.file')
        <small class="text-danger ms-2">{{ $message }}</small>
    @enderror
</div>
