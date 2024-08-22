<div>
    @props([
            'question',
            'name',
            'required',
            'hint',
            'options',
            'reason',
            'answers',
            'no',
            'matriks',
            'vertical',
        ])

    <label for="answers_{{ $name }}" class="form-label {{ $required == 1 ? 'required' : '' }}">{{ $no }}. {{ $question ?? '' }}</label>

    <div class="d-block">
        <div class="row">
            <div class="col-12 col-md-6">
                @if($vertical && $matriks)
                <table class="table table-borderless ms-2">
                    <thead>
                        <th></th>
                        @foreach ($vertical as $v)
                            <th class="text-capitalize text-center" style="font-weight: 400">{{ $v }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($matriks as $k => $m)
                            <tr>
                                <td class="text-capitalize col-auto">{{ $m['question'] }} <br>
                                    @error('answers.'.$name.'.'.$k)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </td>
                                @foreach ($vertical as $v)
                                    <td class="text-capitalize text-center fw-thin">
                                        <div class="form-check form-check-inline me-0">
                                            <input class="form-check-input me-0" type="radio" wire:model.live="answers.{{ $name }}.{{ $k }}" name="matrik_{{ $name.$k }}" id="matrik_{{ $name.$k }}" value="{{ $v }}">
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @error('answers.'.$name)
                <span class="text-danger ms-2">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>
