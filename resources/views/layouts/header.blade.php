<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="{{ asset('css/flexslider.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/swiper.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <script src="//code.tidio.co/dqvb1pwlncoi0ko1ujek5snkwywy4cbg.js"></script>
</head>
<body>
<div class="row primary-nav">
    <div class="container">
        <ul class="login-reg">
            @guest
                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                <li><a href="{{ route('register') }}">Đăng ký</a></li>
                @else
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li><a href="{{ route('orderhistory') }}">Lịch sử mua hàng</a></li>
                    <li><a href="{{ route('account') }}">Thông tin tài khoản</a></li>
                    @if(auth()->user()->isAdmin())
                        <li><a href='{{ route('admin') }}' target='_blank'>Trang quản trị</a></li>
                    @endif
                    <li><a>Xin chào <span style="color: #1087dd">{{ Auth::user()->name }}</span></a></li>
                    @endguest
        </ul>
    </div>
</div>
<div class=" row header">
    <div class="container">
        <div class="col-md-2">
            <a href="{{ route('home') }}" class="logo"></a>
        </div>
        <div class="col-md-6 search">
            {{--{!! Form::open(['method' => 'GET', 'action' => 'SearchController@index' ]) !!}--}}
                <div class="input-group">
                    {!! Form::text('keyword', null, ['class' => 'form-control searchinput', 'placeholder' => 'Tìm sách, danh mục, tác giả hoặc nhà xuất bản mong muốn...']) !!}
                    <span class="input-group-btn">
                        {!! Form::submit(null, ['class' => 'searchsubmit']) !!}
                    </span>
                </div>
            {{--{!! Form::close() !!}--}}
            {{--<form action="{{ route('search') }}" method="get">--}}
                {{--<div class="input-group">--}}
                    {{--<input type="text" name="keyword" class="form-control searchinput" placeholder="Tìm sách, danh mục, tác giả hoặc nhà xuất bản mong muốn...">--}}
                    {{--<span class="input-group-btn">--}}
                        {{--<input type="submit" class="searchsubmit" />--}}
                    {{--</span>--}}
                {{--</div><!-- /input-group -->--}}
            {{--</form>--}}
        </div>
        <div class="col-md-2 col-md-offset-1">
            <div class="shopcart">
                <a href="{{ route('cart') }}">
                    <img src="{{ asset('images/shoppingcart.png') }}" class="iconcart" />
                    <span style="color: white; font-weight: bold; margin-left: 27px;">Giỏ hàng</span>
                    <span class="cart-count">
                        {{ Cart::count() }}
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="alert alert-success alert-dismissible cart-message">
        <a href="#" class="close" onclick="$('.alert').hide()" aria-label="close">&times;</a>
        <strong>Thêm vào giỏ hàng thành công !</strong> <div>Click vào giỏ hàng để xem chi tiết.</div>
    </div>
</div>
<nav class="navbar navbar-default menu">
    <div class="container menu-inner">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('home') }}">Trang chủ</a></li>
                @foreach($categories as $category)
                    <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>