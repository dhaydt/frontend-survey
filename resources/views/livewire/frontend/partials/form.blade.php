@foreach ($questions as $k => $q)
@if($q['input'])
    @if(strTolower($q['input']['name']) == 'file doc & pdf')
        <div class="card card-body shadow-sm mt-2">
            <x-dynamic-component
                :component="'input.file-doc-pdf'"
                :question="$q['question']"
                :name="$q['id']"
                :hint="$q['hint']"
                :options="$q['options']"
                :required="$q['is_required']"
                :reason="$q['need_reason']"
                :image="$q['image']"
                :audio="$q['audio']"
                :no="$k + 1"
                :answers="$answers"
                :matriks="$q['matriks']"
                :ranking="$q['ranking']"
                :vertical="$q['vertical_options']"
                class="mt-4" />
        </div>
    @else
    @if (isset($q['input']['name']))
    <div class="card card-body shadow-sm mt-2 dynamic overflow-hidden">
        <x-dynamic-component :component="'input.'.strToLower(str_replace(' ','-',$q['input']['name']))"
            class="mt-4"
            :question="$q['question']"
            :name="$q['id']"
            :hint="$q['hint']"
            :options="$q['options']"
            :required="$q['is_required']"
            :reason="$q['need_reason']"
            :image="$q['image']"
            :audio="$q['audio']"
            :no="$k + 1"
            :answers="$answers"
            :matriks="$q['matriks']"
            :ranking="$q['ranking']"
            :vertical="$q['vertical_options']"
        />
    </div>
    @endif
    @endif
@endif
@endforeach
