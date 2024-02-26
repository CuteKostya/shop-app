@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('main_content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Описание</th>
            <th scope="col">Цена</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <div class="col-12 col-md-4">
                <td>
                    {{ $product->id }}
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->description }}
                </td>
                <td>
                    {{ $product->price }}
                </td>
            </div>
        </tr>

        </tbody>
    </table>

@endsection