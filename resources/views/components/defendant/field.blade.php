<td>
    <a href="{{route('answers.show', $defendant->id)}}">
        {{ $defendant->id }}
    </a>
</td>
<td>
    {{ $defendant->users_id }}
</td>
<td>
    {{ $defendant->name }}
</td>

<td>
    <a href="{{route('defendants.edit',$defendant->id)}}">
        {{__('Изменить')}}
    </a>
</td>
<td>
    <form action="{{route('defendants.delete', $defendant->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <x-button type="submit">
            {{'Delete'}}
        </x-button>
    </form>
</td>



