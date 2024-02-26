<td>
    {{ $employee->id }}
</td>
<td>
    {{ $employee->name }}
</td>
<td>
    {{ $employee->age }}
</td>
<td>
    {{ $employee->salary }}
</td>
<td>
    <a href="{{ Storage::url($employee->path) }}" download target="_blank">{{ $employee->path }}</a>
</td>
<td>
    <a href="{{route('employees.edit',$employee->id)}}">
        {{__('Изменить')}}
    </a>

</td>
<td>
    <form action="{{route('employees.delete', $employee->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <x-button type="submit">
            {{'Delete'}}
        </x-button>
    </form>
</td>

