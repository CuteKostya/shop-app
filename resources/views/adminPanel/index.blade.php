@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('main_content')

    @if($products->isEmpty())
        {{  __("Товаров нет")}}
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Описание</th>
                <th scope="col">Цена</th>
                <th scope="col">Корзина</th>
                <th scope="col">Корзина</th>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $product)
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
                        <td>
                            <form action="{{route('admin-panel.destroy', $product->id)}}" method="GET">
                                <x-button type="submit">
                                    {{'Редактировать'}}
                                </x-button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('admin-panel.destroy', $product->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <x-button type="submit" class="btn-dark btn-outline-danger">
                                    {{'Удалить'}}
                                </x-button>
                            </form>
                        </td>
                    </div>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection