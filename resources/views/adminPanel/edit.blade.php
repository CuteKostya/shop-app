@extends('layouts.main')

@section('title')
    {{__('Таблица')}}
@endsection

@section('main_content')
    <main class="flex-shrink-0">
        <div class="container">
            <x-card>
                <h3>Edit </h3>
                <x-product.form action="{{ route('admin-panel.update', $product->id) }}" method="put"
                                :product="$product"/>

            </x-card>

        </div>
    </main>

@endsection

