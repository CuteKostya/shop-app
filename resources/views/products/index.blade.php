@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('main_content')
    <div class="container">
        @if($products->isEmpty())
            {{  __("Товаров нет")}}
        @else
            @foreach($products as $key => $product)
                <div class="row border bg-light mt-3">
                    <div class="col-3 pb-4"
                         style="min-height: 200px;">
                        @if($images->find($product->id))
                            <img src=" {{$images->find($product->id)->url}}" class="img-fluid" alt="Responsive image">
                        @endif
                    </div>
                    <div class="col-7">
                        <a class="fs-3 text-decoration-none " href="{{route('products.show', $product->id)}}">
                            {{ $product->name }}
                        </a>
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="col-2">
                        <text class="fs-4"> {{ $product->price }} </text>
                        <text class=" text-black-50">P</text>
                        <div class="col-6">
                            @if($product->grade != 0)
                                <div class="stars float-right">
                                    @for($i=5; $i>0; $i--)
                                        <label class="stars__label {{ ($product->grade == $i) ? ' checked' : '' }}">
                                            <input type="radio" name="star" value="{{$i}}" class="stars__input">
                                        </label>
                                    @endfor
                                </div>
                            @endif
                            <div class="position-absolute pt-5" id="formAddProduct{{$product->id}}"
                                 style="display: {{$product->count ? 'block': 'none'}}">

                                <div class="row justify-content-start">
                                    <div class="col-4">
                                        <x-button type="submit" class=" btn-lg btn-secondary" name="action"
                                                  onclick="updateToBasket({{$product->id}}, 'decrease')"
                                                  value="decrease">-
                                        </x-button>
                                    </div>
                                    <div class="col-1">
                                        <span id="countProduct{{$product->id}}" class="text-lg-center">
                                            {{ $product->count }}
                                        </span>
                                    </div>
                                    <div class="col-1">
                                        <x-button class=" btn-lg btn-secondary"
                                                  name="action"
                                                  onclick="updateToBasket({{$product->id}}, 'increase')"
                                                  value="increase">+
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                            <x-button style="display: {{$product->count ? 'none': 'block'}}"
                                      onclick="addToBasket({{$product->id}})" id="buttonAddProduct{{$product->id}}">
                                {{'Добавить'}}
                            </x-button>
                        </div>

                    </div>
                </div>
            @endforeach

            {{$products->links()}}
        @endif

        <script>
            function updateToBasket(productId, sign) {
                $.ajax({
                    url: "/products/" + productId,
                    type: "put",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId,
                        sign: sign,
                    },
                    success: function (data) {
                        $("#countProduct" + productId).text(data['count']);
                        if (data['count'] <= 0) {
                            $("#buttonAddProduct" + productId).css("display", "block");
                            $("#formAddProduct" + productId).css("display", "none");
                        }
                        extracted();
                        console.log(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

            function addToBasket(productId) {
                $.ajax({
                    url: "/basket/store",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId,
                    },

                    success: function (data) {
                        if (data['count'] > 0) {
                            $("#buttonAddProduct" + data['productId']).css("display", "none");
                            $("#formAddProduct" + data['productId']).css("display", "block");
                            $("#countProduct" + data['productId']).text(data['count']);

                        }
                        console.log(data['productId']);
                        extracted();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

        </script>
    </div>
@endsection