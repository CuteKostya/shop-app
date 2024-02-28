@extends('layouts.main')

@section('title', 'Создать товар')

@section('main_content')
    <main class="flex-shrink-0">
        <div class="container">
            <x-card>
                <h3>Add new </h3>
                <x-product.form action="{{ route('admin-panel.store') }}" method="post"/>

            </x-card>

        </div>
    </main>

@endsection

