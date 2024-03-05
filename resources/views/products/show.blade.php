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
    <x-form action="{{ route('comment.store') }}" method="POST">
        <x-input type="hidden" name="id" value="{{$product->id}}"/>
        <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
        </br>
        <x-button type="submit">Отправить</x-button>
    </x-form>
    </br>
    </br>
    @foreach($comments as $comment)
        <div class="container">
            <div class="row">
                <div class="col-2 card card-body">
                    {{$comment->user_id}}
                </div>
                <div class="col-10 card card-body">
                    {{$comment->description}}
                </div>
            </div>
        </div>
    @endforeach
@endsection