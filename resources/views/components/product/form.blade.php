@props(['products' =>null])


<x-form {{ $attributes }} enctype="multipart/form-data">
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
