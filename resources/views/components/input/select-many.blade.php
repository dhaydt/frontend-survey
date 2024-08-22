<div>
    @props([
            'question',
            'name',
            'required',
            'hint',
            'options',
            'reason',
            'no',
        ])
    <label for="exampleInputEmail1" class="form-label {{ $required == 1 ? 'required' : '' }}">{{ $no }}. {{ $question ?? '' }}</label>

    @foreach ($options as $k => $o)
        @if ($o['nilai'])
            <div class="form-check mb-2 ms-2">
                <input class="form-check-input" type="checkbox" wire:model.live="answers.{{ $name }}" value="{{ $o['nilai'] }}" id="many_{{ $name.$k }}" name="{{ $name }}">
                <label class="form-check-label" for="many_{{ $name.$k }}">
                    {{ $o['nilai'] }}
                </label>
            </div>
        @endif
    @endforeach

    @if ($hint !== null && $hint !== "")
    <div id="{{ $name }}" class="form-text ms-2">{{ $hint }}</div>
    @endif
    @error('answers.'.$name)
        <small class="text-danger ms-2">{{ $message }}</small>
    @enderror
</div>
