@props(['product' => null])


<x-form {{ $attributes }} enctype="multipart/form-data" id="contactForm">
    <x-form-item>
        <x-label required>
            {{ __('Name') }}
        </x-label>
        <x-input type="text" name="name" value="{{ $product->name ?? '' }}"/>
    </x-form-item>

    <x-form-item>
        <x-label required>
            {{ __('description') }}
        </x-label>
        <x-input type="text" name="description" value="{{ $product->description  ?? ''}}"/>
    </x-form-item>

    <x-form-item>
        <x-label required>
            {{ __('price') }}
        </x-label>
        <x-input type="number" name="price" value="{{ $product->price  ?? ''}}"/>
    </x-form-item>

    <x-button type="submit" class="btn btn-primary">Submit</x-button>
</x-form>

<script>

    $('#contactForm').submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        let name = formData.get('name');
        let description = formData.get('description');
        let price = formData.get('price');

        console.log(formData.get('name'));
        $.ajax({
            url: "/adminPanel/store",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                name: name,
                description: description,
                price: price,
            },
            success: function (data) {
                console.log(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    })
    ;
</script>