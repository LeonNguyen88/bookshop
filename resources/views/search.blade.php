@extends('layouts.front-end2')

@section('content')
    <h2 class="page-header">Tìm thấy {{ $count }} kết quả tìm kiếm phù hợp với từ khóa '{{ $keyword }}'</h2>
    @foreach($products as $product)
        <div class="col-md-3">
            <a href="{{ route('product', $product->id) }}" title="{{ $product->name }}">
                <div class="product-image">
                    @foreach($product->photo as $photo)
                        @if($photo->is_cover == 1)
                            <img class="product-thumbnail" src="{{ $photo->photo_url }}" />
                        @endif
                    @endforeach
                </div>
                <div class="product-title">
                    {{ limit_character($product->name) }}
                </div>
                <div class="product-priceold">
                    {{ format_money($product->price) }} VND
                </div>
                <div class="product-price">
                    {{ format_money($product->price - $product->sale) }} VND
                </div>
                <div class="product-review">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
                <a href="{{ route('addtocart', $product->id) }}" class="btn btn-primary addtocart-btn add-to-cart-js" data-id="{{ $product->id }}">
                    <span class="fa fas fa-cart-plus"></span>
                    <span class="addtocart">Thêm vào giỏ hàng</span>
                </a>
            </a>
        </div>
    @endforeach
@stop