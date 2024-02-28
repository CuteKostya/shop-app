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
                <th scope="col">Просмотр</th>
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
                            <form action="{{route('products.show', $product->id)}}" method="get">
                                <x-button type="submit">
                                    {{'Просмотреть'}}
                                </x-button>
                            </form>
                        </td>
                        <td>
                            @if($product->count)

                                <x-form action="{{ route('products.update', $product->id) }}" method="put">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-secondary" name="action"
                                                    value="decrease">-
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <label>
                                                <input name="quantity"
                                                       style="width: 30px"
                                                       value=" {{ $product->count }}">
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-secondary" name="action"
                                                    value="increase">+
                                            </button>
                                        </div>
                                    </div>
                                </x-form>

                            @else
                                <form action="{{route('basket.store')}}" method="GET">
                                    <x-input type="hidden" name="id" value="{{$product->id}}"/>
                                    <x-button type="submit">
                                        {{'Добавить'}}
                                    </x-button>
                                </form>
                            @endif

                        </td>
                    </div>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    @endif
@endsection