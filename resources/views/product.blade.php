@extends('layouts.front-end3')
@section('js')
    <script src="{{ asset('js/myscript.js') }}"></script>
@stop
@section('content')
<div class="container product-page-top">
        <div class="col-md-4">
            @foreach($product->photo as $photo)
                @if($photo->is_cover == 1)
                    <img src="{{ $photo->photo_url }}" width="400" />
                @endif
            @endforeach
            <div class="thumbnail-item-bar">
                @foreach($thumbnails as $thumbnail)
                    <img class="thumbnail-item" src="{{ $thumbnail->photo_url }}" width="90" height="90" />
                @endforeach
            </div>
        </div>

    <div class="col-md-8">
        <div class="info-box-header">
            <div class="col-md-10 info-box-title">
                    <h1>{{ $product->name }}</h1>
                    <h3 style="color: #8c8c8c; margin-top: 10px;">{{ $product->product_detail->author }}</h3>
                    <div class="product-review-big">
                        @if($review_qty > 0)
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="fa fa-star {{ $i <= $product->rating_cache ? 'checked' : '' }}"></span>
                                @endfor
                        @endif
                    </div>
                </div>
            <div class="col-md-2">
                @if($product->quantity > 0)
                    <img src="{{ asset('images/con-hang.png') }}" width="100" style="margin-top: 27px" />
                @else
                    <img src="{{ asset('images/het-hang.png') }}" width="100" style="margin-top: 27px" />
                @endif
            </div>
        </div>
        <div class="info-box-detail">
            <p>Giá tiền: <span class="product-price">{{ number_format($product->price - $product->sale, 0, ',', '.') }} VND</span></p>
            <p>Giá thị trường: <span class="product-priceold">{{ number_format($product->price, 0, ',', '.') }} VND</span></p>
            <div class="info-box-tips">
                <p>
                    <span><img class="info-box-icon" src="{{ asset('images/replay2.png') }}" /></span>
                    Đổi trả dễ dàng trong 1 tuần
                </p>
                <p>
                    <span><img class="info-box-icon" src="{{ asset('images/avzmqvxyzfhcbfkkzgha.png') }}" /></span>
                    Giao hàng miễn phí toàn quốc
                </p>
                <p>
                    <span><img class="info-box-icon" src="{{ asset('images/218780527bb8acc76f78fecaca298342.png') }}" /></span>
                    Cho phép kiểm tra sách trước khi giao tiền
                </p>
                <p>
                    <span><img class="info-box-icon" src="{{ asset('images/orange-phone-hi.png') }}" /></span>
                    Gọi đặt mua: 0120 549 1108
                </p>
            </div>
            <a href="{{ route('addtocart', $product->id) }}" class="btn btn-danger add-to-cart-js" data-id="{{ $product->id }}"><span><img class="add-shopping-cart-icon" src="{{ asset('images/add-shopping-cart.png') }}" /></span>Thêm vào giỏ hàng</a>
        </div>
    </div>
</div>
<div class="container">
    <h2 class="title-header">
       GIỚI THIỆU SÁCH
    </h2>
    <div class="product-detail-box">
            {{ $product->description }}
            <table class="table table-bordered product-info">
                <tr>
                    <th>Công ty phát hành</th>
                    <td>{{ $product->product_detail->issuer }}</td>
                </tr>
                <tr>
                    <th>Nhà xuất bản</th>
                    <td>{{ $product->product_detail->publisher }}</td>
                </tr>
                <tr>
                    <th>Tác giả</th>
                    <td>{{ $product->product_detail->author }}</td>
                </tr>
                <tr>
                    <th>Kích thước</th>
                    <td>{{ $product->product_detail->size }}</td>
                </tr>
                <tr>
                    <th>Loại bìa</th>
                    <td>{{ $product->product_detail->cover }}</td>
                </tr>
                <tr>
                    <th>Số trang</th>
                    <td>{{ $product->product_detail->num_page }}</td>
                </tr>
                <tr>
                    <th>Ngày xuất bản</th>
                    <td>{{ $product->product_detail->date_publish }}</td>
                </tr>
                <tr>
                    <th>Tình trạng</th>
                    <td>{{ $product->product_detail->status }}</td>
                </tr>
                <tr>
                    <th>Số lượng</th>
                    <td>{{ $product->quantity }}</td>
                </tr>
            </table>

    </div>
    <h2 class="title-header">
        SẢN PHẨM LIÊN QUAN
    </h2>
    <div class="product-box" style="clear:left">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($related_products as $related_product )
                    <div class="swiper-slide">
                        <div class="col-md-2 product-item">
                            <a href="{{ route('product', $related_product->id) }}" title="{{ $related_product->name }}">
                                <div class="product-image">
                                    @foreach($related_product->photo as $photo)
                                        @if($photo->is_cover == 1)
                                            <img class="product-thumbnail" src="{{ $photo->photo_url }}" />
                                        @endif
                                    @endforeach
                                </div>
                                <div class="product-title">
                                    {{ limit_character($related_product->name) }}
                                </div>
                                <div class="product-priceold">
                                    {{ number_format($related_product->price, 0, ',', '.') }} VND
                                </div>
                                <div class="product-price">
                                    {{ number_format($related_product->price - $related_product->sale, 0, ',', '.') }} VND
                                </div>
                                <div class="product-review">
                                    @if($related_product->rating_cache != 0)
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="fa fa-star {{ $i <= $related_product->rating_cache ? 'checked' : '' }}"></span>
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
                slidesPerView: 5,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>
    </div>
    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#home">Đánh giá sản phẩm</a></li>
        <li><a data-toggle="pill" href="#menu1">Hỏi & Đáp</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <div class="col-md-7">
                @if($review_qty > 0)
                    @foreach($reviews as $review)
                        <div class="user-review-box">
                            <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                            <div class="reply-detail">
                                <span class="username-review">{{ $review->user->realname }}</span> <span class="date-review">{{ $review->created_at->format('H:i:s d/m/Y') }}</span>
                                <div class="product-review">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fa fa-star {{ $i <= $review->rating ? 'checked' : '' }}"></span>
                                    @endfor
                                </div>
                                <div class="user-review-content">
                                    {{ $review->content }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-6 col-md-offset-5">
                            {{ $reviews->render() }}
                        </div>
                    </div>
                @else
                    <h4>Chưa có đánh giá nào ! Hãy là người đầu tiên đánh giá sản phẩm này.</h4>
                @endif
            </div>
            <div class="col-md-5 review-col-left">
                @if($review_qty > 0)
                    <h3>Điểm đánh giá trung bình của sản phẩm</h3>
                    <span class="product-review">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="fa fa-star {{ $i <= $product->rating_cache ? 'checked' : '' }}"></span>
                            @endfor
                    </span><span style="font-size: 27px; color: #8c8c8c">({{ $review_qty }} nhận xét)</span>
                    <div class="rating-box">
                        @for($i = 5; $i >= 1; $i--)
                            <div class="row-rate">
                                <span class="rating-num">{{ $i }} sao</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ count($product->reviews->where('rating', $i))/$review_qty*100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ count($product->reviews->where('rating', $i))/$review_qty*100 }}%;">
                                        <span class="sr-only">{{ count($product->reviews->where('rating', $i))/$review_qty*100 }}% Complete</span>
                                    </div>
                                </div>
                                <span>({{ count($product->reviews->where('rating', $i)) }})</span>
                            </div>
                        @endfor
                    </div>
                @endif
                {!! Form::open(['method' => 'POST', 'action' => ['ReviewController@store', $product->id]]) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '10', 'placeholder' => 'Nhập nhận xét về sản phẩm này của bạn', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label(null, 'Đánh giá của bạn:', ['class' => 'yourreviewstar']) !!}
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5" required /><label class = "full" for="star5" title="5 sao"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="4 sao"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="3 sao"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="2 sao"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="1 sao"></label>
                        </fieldset>
                    </div>
                    <div style="clear: left"></div>
                    <div class="form-group">
                        {!! Form::submit('GỬI', ['class' => 'btn btn-warning', 'name' => 'review-submit']) !!}
                    </div>
                    {{ csrf_field() }}
                {!! Form::close() !!}
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Bạn có bình luận với sản phẩm này? Hãy đặt bình luận ở đây</h3>
            <div class="col-md-8">
                {!! Form::open(['method' => 'POST', 'action' => ['CommentController@store', $product->id]]) !!}
                <div class="form-group">
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Đặt bình luận']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('GỬI', ['class' => 'btn btn-warning', 'name' => 'comment-submit']) !!}
                </div>
                {{ csrf_field() }}
                {!! Form::close() !!}
                <div class="list-comment-box">
                    <h3 class="page-header">Có {{ $cmt_qty }} bình luận về sản phẩm này</h3>
                    @foreach($cmt as $cmt_item)
                        <div class="user-comment-box">
                            <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                            <div class="comment-detail">
                                <span class="username-comment">{{ $cmt_item->user->realname }}</span> <span class="date-review">{{ $cmt_item->created_at->format('H:i:s d/m/Y') }}</span>
                                <div class="user-comment-content">
                                    {{ $cmt_item->content }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop