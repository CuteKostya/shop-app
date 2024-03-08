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
        function addComment(productId) {
            var textComment = $("#textComment").val();
            var grade = $(".stars").children(".checked").children().val();

            $.ajax({
                url: "/comment/store",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    productId: productId,
                    textComment: textComment,
                    grade: grade,
                },

                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus)
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $(function () {
            var $star = $('.stars_id');

            $star.click(function () {
                if (!$(this).hasClass('checked')) {
                    $star.removeClass('checked');
                    $(this).addClass('checked');
                } else {
                    $(this).removeClass('checked');
                    $(this).find('input').prop('checked', false);
                }

            });

        });

    </script>
    <style>
        .stars {
            display: flex;
            direction: rtl;
            justify-content: space-between;
            overflow: hidden;
            width: 95px;
            margin: 0 0 10px;
        }

        .stars__label {
            position: relative;
            width: 15px;
            height: 15px;
            filter: grayscale(1);
            transition: .15s;
            overflow: hidden;
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NDkxMSwgMjAxMy8xMC8yOS0xMTo0NzoxNiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBODE5OTIzM0VEMTIxMUU2ODAxRkY1QkNEOUNGNTNBRSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBODE5OTIzNEVEMTIxMUU2ODAxRkY1QkNEOUNGNTNBRSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkE4MTk5MjMxRUQxMjExRTY4MDFGRjVCQ0Q5Q0Y1M0FFIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkE4MTk5MjMyRUQxMjExRTY4MDFGRjVCQ0Q5Q0Y1M0FFIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+qPqbrAAAAddJREFUeNpMUzsvBFEYPXNnH+xaxHqHSERWokDhkS00CiReP8APEJ0/oBE9nUQtatXqKERUGhItIiJRWNZjsTtznfnmM3Zmztz57v1e59w7jl0H0ERkiCr+L4f4wQziOOP3RzTvEt/A7WMGJpq04hyiKg4GFezS7hO7EgaJn14xeftqtROe2haTdO5HAsNMcy3rCeJdfXiZqEVfRzdKOy104piTaq6uWx3FxanhWVX+YWvLktpigXB5eyj9t+1zImh7lughriSZpYuHATRgHHWSMItXrPGrwLUuYW+RS5mfskO1p1jtiM5pUTxNNOqYUKE+iaBqoPmb8i5hxbD+KVvPsGYh4mw0MEiQVPuPcwyXtFsYd2BEOY+N+JgnVoWTp1tW1u3xlKuPLWKEdjHoKIaUipSUdvf4TjFoW6p8aWBZxj36bciu+GHSGIb4Ua9KG+GTj7bO1fFLuE9QFwiCYlmysBsaaGVPm3k/UeW4nC9gn1hkglZpv4Qx0rlQ7nw6as5akY4vDEwx0JEtPGGSQSY+puLdFHEJnQzWE+bYzZoD/45zZs5R+16m+BQdqipesGZ4zhuZJDqeD3wHuEMbnnEobFwGmpq/K/wD8uxqBzcYxT0t4leAAQA4Q5FZyHThVAAAAABJRU5ErkJggg==');
        }

        .stars_id:hover,
        .stars_id:hover ~ .stars_id,
        .stars__label.checked,
        .stars__label.checked ~ .stars__label {
            filter: grayscale(0);
        }

        .stars__input {
            position: absolute;
            left: -5px;
            top: -5px;
            width: 30px;
            height: 30px;
            margin: 0;
            border-radius: 0;
            opacity: 0;
        }
    </style>
@endsection