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
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
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
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
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
                <div class="user-review-box">
                    <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                    <div class="reply-detail">
                        <span class="username-review">Nguyễn Ngọc Doanh</span> <span class="date-review">2018-03-15 00:14:21</span>
                        <div class="product-review">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="user-review-content">
                            Mình mua máy được khoảng 1 tuần có mấy nhận xét để các bạn tham khảo nhé Ưu điểm pin trâu .màn hình đẹp hiển thị tốt ngoài trời nắng. Chiến game tốt. Có chế độ 2 màn hình cực thích Chơi game cả ngày máy ko nóng kể cả khi đang sạc Chế độ allway on display Lọc sáng xanh ko bị mỏi mắt khi dùng lâu Còn một số nhược điểm mh chưa thực sự thích là Máy có trọng lượng khá nặng có lẽ do viên pin+thân máy kim loại Vân tay 1 chạm ko nhạy lắm. Nếu đeo găng tay thì ko thao tác dc Cổng 3.5 phát ra amply hơi nhỏ và ko trung thực Lâu dài thì chưa biết nhưng nói chung vs mh thì j7 pro 8 điểm Chúc các bạn chọn dc chiếc dế ưng ý
                        </div>
                    </div>
                </div>
                <div class="user-review-box">
                    <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                    <div class="reply-detail">
                        <span class="username-review">Nguyễn Ngọc Doanh</span> <span class="date-review">2018-03-15 00:14:21</span>
                        <div class="product-review">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="user-review-content">
                            Mình mua máy được khoảng 1 tuần có mấy nhận xét để các bạn tham khảo nhé Ưu điểm pin trâu .màn hình đẹp hiển thị tốt ngoài trời nắng. Chiến game tốt. Có chế độ 2 màn hình cực thích Chơi game cả ngày máy ko nóng kể cả khi đang sạc Chế độ allway on display Lọc sáng xanh ko bị mỏi mắt khi dùng lâu Còn một số nhược điểm mh chưa thực sự thích là Máy có trọng lượng khá nặng có lẽ do viên pin+thân máy kim loại Vân tay 1 chạm ko nhạy lắm. Nếu đeo găng tay thì ko thao tác dc Cổng 3.5 phát ra amply hơi nhỏ và ko trung thực Lâu dài thì chưa biết nhưng nói chung vs mh thì j7 pro 8 điểm Chúc các bạn chọn dc chiếc dế ưng ý
                        </div>
                    </div>
                </div>
                <div class="user-review-box">
                    <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                    <div class="reply-detail">
                        <span class="username-review">Nguyễn Ngọc Doanh</span> <span class="date-review">2018-03-15 00:14:21</span>
                        <div class="product-review">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="user-review-content">
                            Mình mua máy được khoảng 1 tuần có mấy nhận xét để các bạn tham khảo nhé Ưu điểm pin trâu .màn hình đẹp hiển thị tốt ngoài trời nắng. Chiến game tốt. Có chế độ 2 màn hình cực thích Chơi game cả ngày máy ko nóng kể cả khi đang sạc Chế độ allway on display Lọc sáng xanh ko bị mỏi mắt khi dùng lâu Còn một số nhược điểm mh chưa thực sự thích là Máy có trọng lượng khá nặng có lẽ do viên pin+thân máy kim loại Vân tay 1 chạm ko nhạy lắm. Nếu đeo găng tay thì ko thao tác dc Cổng 3.5 phát ra amply hơi nhỏ và ko trung thực Lâu dài thì chưa biết nhưng nói chung vs mh thì j7 pro 8 điểm Chúc các bạn chọn dc chiếc dế ưng ý
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 review-col-left">
                <h3>Điểm đánh giá trung bình của sản phẩm</h3>
                <div class="product-review">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
                <div class="rating-box">
                    <div class="row-rate">
                        <span class="rating-num">5 sao</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                        <span>(4)</span>
                    </div>
                    <div class="row-rate">
                        <span class="rating-num">4 sao</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                        <span>(4)</span>
                    </div>
                    <div class="row-rate">
                        <span class="rating-num">3 sao</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                        <span>(4)</span>
                    </div>
                    <div class="row-rate">
                        <span class="rating-num">2 sao</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                        <span>(4)</span>
                    </div>
                    <div class="row-rate">
                        <span class="rating-num">1 sao</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>
                        <span>(4)</span>
                    </div>
                </div>
                {!! Form::open(['method' => 'POST', 'action' => ['ProductController@index', $product->id]]) !!}
                    <div class="form-group">
                        {!! Form::textarea('review', null, ['class' => 'form-control', 'rows' => '10', 'placeholder' => 'Nhập nhận xét về sản phẩm này của bạn']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('GỬI', ['class' => 'btn btn-warning', 'name' => 'review-submit']) !!}
                    </div>
                    {{ csrf_field() }}
                {!! Form::close() !!}
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Bạn có câu hỏi với sản phẩm này? Hãy đặt câu hỏi ở đây</h3>
            <div class="col-md-8">
                {!! Form::open(['method' => 'POST', 'action' => ['ProductController@index', $product->id]]) !!}
                <div class="form-group">
                    {!! Form::textarea('review', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Đặt câu hỏi']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('GỬI', ['class' => 'btn btn-warning', 'name' => 'review-submit']) !!}
                </div>
                {{ csrf_field() }}
                {!! Form::close() !!}
                <div class="list-comment-box">
                    <h3 class="page-header">Có 5 câu hỏi về sản phẩm này</h3>
                    <div class="user-comment-box">
                        <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                        <div class="comment-detail">
                            <span class="username-comment">Nguyễn Ngọc Doanh</span> <span class="date-comment">2018-03-15 00:14:21</span>
                            <div class="user-comment-content">
                                Mình mua máy được khoảng 1 tuần có mấy nhận xét để các bạn tham khảo nhé Ưu điểm pin trâu .màn hình đẹp hiển thị tốt ngoài trời nắng. Chiến game tốt. Có chế độ 2 màn hình cực thích Chơi game cả ngày máy ko nóng kể cả khi đang sạc Chế độ allway on display Lọc sáng xanh ko bị mỏi mắt khi dùng lâu Còn một số nhược điểm mh chưa thực sự thích là Máy có trọng lượng khá nặng có lẽ do viên pin+thân máy kim loại Vân tay 1 chạm ko nhạy lắm. Nếu đeo găng tay thì ko thao tác dc Cổng 3.5 phát ra amply hơi nhỏ và ko trung thực Lâu dài thì chưa biết nhưng nói chung vs mh thì j7 pro 8 điểm Chúc các bạn chọn dc chiếc dế ưng ý
                            </div>
                            <a href="" class="reply-button">Trả lời</a>
                        </div>
                    </div>
                    <div class="user-comment-box">
                        <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                        <div class="comment-detail">
                            <span class="username-comment">Nguyễn Ngọc Doanh</span> <span class="date-comment">2018-03-15 00:14:21</span>
                            <div class="user-comment-content">
                                Mình mua máy được khoảng 1 tuần có mấy nhận xét để các bạn tham khảo nhé Ưu điểm pin trâu .màn hình đẹp hiển thị tốt ngoài trời nắng. Chiến game tốt. Có chế độ 2 màn hình cực thích Chơi game cả ngày máy ko nóng kể cả khi đang sạc Chế độ allway on display Lọc sáng xanh ko bị mỏi mắt khi dùng lâu Còn một số nhược điểm mh chưa thực sự thích là Máy có trọng lượng khá nặng có lẽ do viên pin+thân máy kim loại Vân tay 1 chạm ko nhạy lắm. Nếu đeo găng tay thì ko thao tác dc Cổng 3.5 phát ra amply hơi nhỏ và ko trung thực Lâu dài thì chưa biết nhưng nói chung vs mh thì j7 pro 8 điểm Chúc các bạn chọn dc chiếc dế ưng ý
                            </div>
                            <a href="" class="reply-button">Trả lời</a>
                        </div>
                    </div>
                    <div class="user-comment-box">
                        <img class="avatar" src="{{ asset('images/Untitled-1-512.png') }}" width="45" />
                        <div class="comment-detail">
                            <span class="username-comment">Nguyễn Ngọc Doanh</span> <span class="date-comment">2018-03-15 00:14:21</span>
                            <div class="user-comment-content">
                                Mình mua máy được khoảng 1 tuần có mấy nhận xét để các bạn tham khảo nhé Ưu điểm pin trâu .màn hình đẹp hiển thị tốt ngoài trời nắng. Chiến game tốt. Có chế độ 2 màn hình cực thích Chơi game cả ngày máy ko nóng kể cả khi đang sạc Chế độ allway on display Lọc sáng xanh ko bị mỏi mắt khi dùng lâu Còn một số nhược điểm mh chưa thực sự thích là Máy có trọng lượng khá nặng có lẽ do viên pin+thân máy kim loại Vân tay 1 chạm ko nhạy lắm. Nếu đeo găng tay thì ko thao tác dc Cổng 3.5 phát ra amply hơi nhỏ và ko trung thực Lâu dài thì chưa biết nhưng nói chung vs mh thì j7 pro 8 điểm Chúc các bạn chọn dc chiếc dế ưng ý
                            </div>
                            <a href="" class="reply-button">Trả lời</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop