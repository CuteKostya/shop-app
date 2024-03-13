@props(['type' => 'checkbox', 'name'=>'', 'value' => ''])


<div class="input-group">
    <div class="input-group-prepend col-lg-2 col-md-3">
        <span class="input-group-text">        {{ $slot }}</span>
    </div>

    <x-input {{ $attributes->merge([
    'type' => $type,
    'name' => $name,
    'value' => $value,
    'class' => 'col-4'
]) }} />

</div>





