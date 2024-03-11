@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('main_content')

    @if($products->isEmpty())
        {{  __("Товаров нет")}}
    @else
        <div class=" container overflow-hidden">
            @foreach($products as $key => $product)
                <div class="row border bg-light mt-3">
                    <div class="col-3 pb-4">
                        <img src=" {{$images->find($product->id)->url}}" class="img-fluid" alt="Responsive image">

                    </div>
                    <div class="col-7">
                        <a href="{{route('products.show', $product->id)}}">
                            {{ $product->name }}
                        </a>
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="col-2">
                        {{ $product->price }}
                        <div class="col align-self-end">

                            {{ $product->grade }}
                            <div id="formAddProduct{{$product->id}}"
                                 style="display: {{$product->count ? 'block': 'none'}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-secondary" name="action"
                                                onclick="updateToBasket({{$product->id}}, 'decrease')"
                                                value="decrease">-
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input name="quantity" id="countProduct{{$product->id}}"
                                                   style="width: 30px"
                                                   value=" {{ $product->count }}">
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <x-button class="btn btn-secondary" name="action"
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
        </div>
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
                    $("#countProduct" + productId).val(data['count']);
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
                        $("#countProduct" + data['productId']).val(data['count']);

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
@endsection