<x-form-item>
    <h2>
        {{ $question->question }}
    </h2>
    @if($question->type == "text")
        <x-checks type="text" name="{{'q['.$question->id. '][]'}}" value=""/>

    @elseif($question->type == "checkbox")

        @foreach($options as $option)
            @if($option->questions_id == $question->id)
                <x-checks type="checkbox" name="q[{{$question->id}}][]" value="{{$option->id}}">
                    {{ $option->option }}
                </x-checks>
            @endif
        @endforeach

    @elseif($question->type == "radio")

        @foreach($options as $option)
            @if($option->questions_id == $question->id)

                <x-checks type="radio" name="q[{{$question->id}}][]" value="{{$option->id}}">
                    {{ $option->option }}
                </x-checks>
            @endif
        @endforeach
    @endif

    <x-error :name="'q.'.$question->id.'.0'"/>
</x-form-item>