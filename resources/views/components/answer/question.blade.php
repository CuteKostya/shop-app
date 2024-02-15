@if($answer->type == 'text')
    <x-checks type="text" value="{{$answer->text}}" disabled/>
@elseif($answer->type == 'checkbox')
    @if(!$answer->answers_id)
        <x-checks type="checkbox" disabled>
            {{$answer->option}}
        </x-checks>
    @else
        <x-checks type="checkbox" checked disabled>
            {{$answer->option}}
        </x-checks>
    @endif

@elseif($answer->type == 'radio')
    @if(!$answer->answers_id)
        <x-checks type="radio" disabled>
            {{$answer->option}}
        </x-checks>
    @else
        <x-checks type="radio" checked disabled>
            {{$answer->option}}
        </x-checks>
    @endif
@endif



