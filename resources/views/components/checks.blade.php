@props(['type' => 'checkbox', 'name'=>'', 'value' => ''])


<div class="input-group">
    <div class="input-group-prepend col-4">
        <span class="input-group-text">        {{ $slot }}</span>
    </div>

    <x-input {{ $attributes->merge([
    'type' => $type,
    'name' => $name,
    'value' => $value,
]) }} />

</div>





