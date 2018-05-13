@extends('layouts.front-end1')
@section('js')
    <script src="{{ asset('js/slider.js') }}"></script>
    <script defer src="{{ asset('js/jquery.flexslider.js') }}"></script>
@stop
@section('slider')
    <div class="col-md-8">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img src="{{ asset('images/23472848_1593098607396045_2579179792589712298_n.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/23473136_1593098230729416_2734317946106765347_n.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/23517531_1593098780729361_373724688967685581_n.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ asset('images/23622023_1593098744062698_2895308050219367003_n.jpg') }}" />
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="col-md-4 ads-right">
        <img src="{{ asset('images/a6b4993e219842f5d613129f00888754.jpg') }}" width="383" />
        <img src="{{ asset('images/od2ciu4_hfxv.jpg') }}" width="383" />
    </div>
@endsection

@section('content')
    <div class="col-md-9 product-list">
        <div class="hot-title-bar">
            <div class="hot-parentcategory-title">
                <a href="">
                    SÁCH BÁN CHẠY
                </a>
            </div>
        </div>
        <div class="product-box">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($hot_products as $hot_product)
                        <div class="swiper-slide">
                            <div class="col-md-3 product-item">
                                <a href="{{ route('product', $hot_product->id) }}" title="{{ $hot_product->name }}">
                                    <div class="product-image">
                                        @foreach($hot_product->photo as $photo)
                                            @if($photo->is_cover == 1)
                                                <img class="product-thumbnail" src="{{ $photo->photo_url }}" />
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="product-title">
                                        {{ limit_character($hot_product->name) }}
                                    </div>
                                    <div class="product-priceold">
                                        {{ format_money($hot_product->price) }} VND
                                    </div>
                                    <div class="product-price">
                                        {{ format_money($hot_product->price - $hot_product->sale) }} VND
                                    </div>
                                    <div class="product-review">
                                        @if($hot_product->rating_cache != 0)
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="fa fa-star {{ $i <= $hot_product->rating_cache ? 'checked' : '' }}"></span>
                                            @endfor
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- Swiper JS -->
            <script src="{{ asset('js/swiper.min.js') }}"></script>

            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 4,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            </script>
        </div>
        <div class="new-title-bar">
            <div class="new-parentcategory-title">
                <a href="">
                    SÁCH MỚI NHẤT
                </a>
            </div>
        </div>
        <div class="product-box">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($latest_products as $latest_product)
                        <div class="swiper-slide">
                            <div class="col-md-3 product-item">
                                <a href="{{ route('product', $latest_product->id) }}" title="{{ $latest_product->name }}">
                                    <div class="product-image">
                                        @foreach($latest_product->photo as $photo)
                                            @if($photo->is_cover == 1)
                                                <img class="product-thumbnail" src="{{ $photo->photo_url }}" />
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="product-title">
                                        {{ limit_character($latest_product->name) }}
                                    </div>
                                    <div class="product-priceold">
                                        {{ format_money($latest_product->price) }} VND
                                    </div>
                                    <div class="product-price">
                                        {{ format_money($latest_product->price - $latest_product->sale) }} VND
                                    </div>
                                    <div class="product-review">
                                        @if($latest_product->rating_cache != 0)
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="fa fa-star {{ $i <= $latest_product->rating_cache ? 'checked' : '' }}"></span>
                                            @endfor
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- Swiper JS -->
            <script src="{{ asset('js/swiper.min.js') }}"></script>

            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 4,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            </script>
        </div>
        @foreach($categories as $category)
            <div class="title-bar">
                <div class="parentcategory-title">
                    <a href="{{ route('category', $category->id) }}">
                        {{ mb_strtoupper($category->name, "UTF-8") }}
                    </a>
                </div>
                <div class="subcategory-title">
                    <ul>
                        @foreach($list_categories->where('parent_id', $category->id)->sortByDesc('id') as $sub_category)
                            <li><a href="{{ route('category', $sub_category->id) }}">{{ $sub_category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="product-box">
                @foreach($category->products->sortByDesc('id')->take(4) as $product_category)
                    <div class="col-md-3">
                        <a href="{{ route('product', $product_category->id) }}" title="{{ $product_category->name }}">
                            <div class="product-image">
                                @foreach($product_category->photo as $photo)
                                    @if($photo->is_cover == 1)
                                        <img class="product-thumbnail" src="{{ $photo->photo_url }}" />
                                    @endif
                                @endforeach
                            </div>
                            <div class="product-title">
                                {{ limit_character($product_category->name) }}
                            </div>
                            <div class="product-priceold">
                                {{ format_money($product_category->price) }} VND
                            </div>
                            <div class="product-price">
                                {{ format_money($product_category->price - $product_category->sale) }} VND
                            </div>
                            <div class="product-review">
                                @if($product_category->rating_cache != 0)
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fa fa-star {{ $i <= $product_category->rating_cache ? 'checked' : '' }}"></span>
                                    @endfor
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
