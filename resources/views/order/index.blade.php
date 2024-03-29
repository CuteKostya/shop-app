@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('main_content')
    <div class="container">
        @if($orders->isEmpty())
            {{  __("Корзина пуста")}}
        @else
            <a href="{{route('order.export')}}">{{ __('Выгрузить данные') }}</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Просмотреть</th>

                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <div class="col-12 col-md-4">
                            <td>
                                {{ $order->id }}
                            </td>
                            <td>
                                {{ $order->created_at  }}
                            </td>
                            <td>
                                <a href="{{route('order.show', $order->id)}}">Просмотреть</a>
                            </td>
                        </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection