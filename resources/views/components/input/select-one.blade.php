<div>
    @props([
            'question',
            'name',
            'required',
            'hint',
            'options',
            'reason',
            'answers',
            'no'
        ])
    <label for="exampleInputEmail1" class="form-label {{ $required == 1 ? 'required' : '' }}">{{ $no }}. {{ $question ?? '' }}</label>

    @foreach ($options as $k => $o)
        @if (isset($o['nilai']))
            <div class="form-check mb-2 ms-2">
                <input class="form-check-input" wire:model.live="answers.{{ $name }}" type="radio" name="q_{{ $name }}" id="o_{{ $name.$k }}" value="{{ $o['nilai'] }}">
                <label class="form-check-label text-capitalize" for="o_{{ $name.$k }}">
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

    @if ($reason)
        @if ($reason['status'] == true && ($answers[$name] == $reason['option']))
        <input type="text" placeholder="Sebutkan alasannya" wire:model.live="reason.{{ $name }}" name="reason_{{ $name }}" class="form-control mt-2" id="reason_{{ $name }}" required>
        @error('reason.'.$name)
            <small class="text-danger ms-2">{{ $message }}</small>
        @enderror
        @endif
    @endif
</div>
