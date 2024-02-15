<td>
    <a href="{{route('defendants.show', $survey->id)}}">
        {{ $survey->id }}
    </a>
</td>
<td>
    {{ $survey->title }}
</td>
<td>
    {{ $survey->description }}
</td>
<td>
    <form action="{{route('surveys.destroy', $survey->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <x-button type="submit">
            {{'Delete'}}
        </x-button>
    </form>
</td>




