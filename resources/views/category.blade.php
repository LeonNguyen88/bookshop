@extends('layouts.front-end3')

@section('content')
    <div class="container">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img src="{{ asset('images/46de4a56ff651128fe65c733743e3c54.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/acc695d3f6a509ca5825901d52c76ea2.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/c096a22d345dcbdb37300a470cf0a790.jpg') }}" />
                    </li>
                </ul>
            </div>
        </section>
        <!-- jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

        <!-- FlexSlider -->
        <script defer src="{{ asset('js/jquery.flexslider.js') }}"></script>

        <script type="text/javascript">
            $(function(){
                SyntaxHighlighter.all();
            });
            $(window).load(function(){
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function(slider){
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>
    </div>
    <div class="container">
        <div class="col-md-3 category-sidebar">
            <div class="category-list">
                <div class="category-list-header">
                    <span><img src="{{ asset('images/activity-feed-256.png') }}" width="30" /></span>
                    <span style="margin-left: 3px;">DANH MỤC SẢN PHẨM</span>
                </div>
                <div class="category-list-body">
                    <a href="{{ route('category', $category->id) }}" class="parent-category">{{ mb_strtoupper($category->name) }}</a>
                    <ul>
                        @foreach($child_category as $item)
                            <li><a href="{{ route('category', $item->id) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="category-list">
                <div class="category-list-header">
                    <a href="#">
                        <img src="{{ asset('images/search2.png') }}" width="30" />
                        <span style="margin-left: 5px;">TÌM KIẾM THEO GIÁ</span>
                    </a>
                </div>
                <div class="category-list-body">
                    <ul class="search-price">
                        <li><a href="{{ route('category', $real_category->id) }}?price=0 50000">Dưới 50.000 đ</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?price=50000 100000">Từ 50.000 đ đến 100.000 đ</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?price=100000 200000">Từ 100.000 đ đến 200.000 đ</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?price=200000 400000">Từ 200.000 đ đến 400.000 đ</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?price=400000 500000">Từ 400.000 đ đến 500.000 đ</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?price=500000 1000000">Trên 500.000 đ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 category-content">
            <div class="filter-bar">
                <h3 class="category-header">{{ mb_strtoupper($real_category->name) }}</h3>
                <div class="btn-group dropdown-sort">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sắp xếp <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('category', $real_category->id) }}?sort=a-z">Từ A-Z</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?sort=z-a">Từ Z-A</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?sort=priceasc">Giá tăng dần</a></li>
                        <li><a href="{{ route('category', $real_category->id) }}?sort=pricedesc">Giá giảm dần</a></li>
                    </ul>
                </div>
            </div>
            @foreach($products as $product)
                <div class="col-md-3">
                    <a href="{{ route('product', $product->id) }}" title="{{ $product->name }}">
                        <div class="product-image">
                            <img class="product-thumbnail" src="{{ $product->photo->photo_url }}" />
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
                        <a href="{{ route('addtocart', $product->id) }}" class="btn btn-primary addtocart-btn">
                            <span class="fa fas fa-cart-plus"></span>
                            <span class="addtocart">Thêm vào giỏ hàng</span>
                        </a>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@stop