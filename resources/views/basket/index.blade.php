@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('main_content')

    @if($products->isEmpty())
        {{  __("Корзина пуста")}}
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
                <th scope="col">Удалить</th>
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
                            {{ $product->name  }}
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            {{ $product->count }}
                        </td>
                        <td>
                            <form action="{{route('basket.destroy', $product->id)}}" method="POST">
                                @csrf
                                @method('delete')
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