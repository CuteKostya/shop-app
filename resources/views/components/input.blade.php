@props(['value' => '', 'type' => 'text', 'checked' => false])

@if($attributes->get('name') != '' && old($attributes->get('name')[0]) != null && $attributes->get('name')[0] == 'q')
    @php
        if($attributes->get('name')[0])
            if ($type == 'text'){
                $str = str_replace(['][', '[', ']', 'q'], '', $attributes->get('name'));

                $value = data_get(old($attributes->get('name')[0]), $str . '.0', '');
            }
            else{
                $str = str_replace(['][', '[', ']', 'q'], '', $attributes->get('name'));
                       if( array_key_exists($str, old($attributes->get('name')[0]))){
                foreach (old($attributes->get('name')[0])[$str] as $item){

                    if ($item == $value){
                        $checked = true;
                    }
                 }}
            }
    @endphp
@endif

<input {{ $attributes->class([
    (($type == 'checkbox' || $type == 'radio') ? 'form-check-input' : 'form-control'),

])->merge([
    'type' => $type,
    'value' =>  $value,
  'checked' => $checked,
]) }}>

