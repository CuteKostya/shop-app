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

    <div class="stars">
        @for($i=5; $i>0; $i--)
            <label class="stars__label stars_id">
                <input type="radio" name="star" value="{{$i}}" class="stars__input">
            </label>
        @endfor
    </div>
    <div>
        <textarea class="form-control" aria-label="With textarea" id="textComment"></textarea>
        </br>
        <x-button type="submit" onclick="addComment({{$product->id}})">Отправить</x-button>
    </div>
    </br>
    </br>
    @foreach($comments as $comment)
        <div class="container">
            <div class="row">
                <div class="col-2 card card-body">
                    {{$comment->name}}
                    </br>
                    {{$comment->updated_at}}
                </div>
                <div class="col-10 card card-body">
                    {{$comment->description}}
                    <div class="stars float-right">
                        @for($i=5; $i>0; $i--)
                            <label class="stars__label {{ ($comment->grade == $i) ? ' checked' : '' }}">
                                <input type="radio" name="star" value="{{$i}}" class="stars__input">
                            </label>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>


    </script>
@endsection