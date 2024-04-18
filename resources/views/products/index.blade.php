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
                            <average-star-component :product_grade="{{$product->grade}}">
                            </average-star-component>
                            <changes-count-products-component :product_id="{{$product->id}}"
                                                              :product_count="{{$product->count}}"></changes-count-products-component>
                        </div>

                    </div>
                </div>
            @endforeach

            {{$products->links()}}
        @endif
    </div>
@endsection