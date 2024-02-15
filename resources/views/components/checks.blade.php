@props(['type' => 'checkbox', 'name'=>'', 'value' => ''])

<x-label>
    {{ $slot }}
</x-label>

<x-input {{ $attributes->merge([
    'type' => $type,
    'name' => $name,
    'value' => $value,
]) }} />


