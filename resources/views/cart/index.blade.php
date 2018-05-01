@extends('layouts.front-end3')

@section('js')
    <script src="{{ asset('js/myscript.js') }}"></script>
@stop
@section('content')
<div class="container">
    <h2 class="title-header">GIỎ HÀNG</h2>
    <table class="table table-bordered cart-table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Hình sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if(Cart::count() == 0)
                <tr>
                    <td colspan="6">Không có sản phẩm nào trong giỏ hàng của bạn</td>
                </tr>
            @endif
            @foreach($carts as $cart)
                <tr class="row_cart{{ $cart->id }}">
                    <td><a class="name" href="{{ route('product', $cart->id) }}" target="_blank">{{ $cart->name }}</a></td>
                    <td><img src="{{ $cart->options->image }}" width="100" /></td>
                    <td>
                        <div class="product-price">{{ format_money($cart->price)  }} VND</div>
                        <div class="product-priceold">{{ format_money($cart->options->old_price) }} VND</div>
                    </td>
                    <td class="blah"><div class="item_qty{{ $cart->id }}" data-id="{{ $cart->id }}">{{ $cart->qty }}</div></td>
                    <td><span class="item_price{{ $cart->id }}" data-id="{{ $cart->id }}"> {{ format_money($cart->price * $cart->qty) }}</span> VND</td>
                    <td class="cart-action">
                        <a href="{{ route('addtocart', $cart->id) }}" data-id="{{ $cart->id }}" class="addqty" title="Thêm số lượng">
                            <i class="fa fas fa-plus-circle"></i>
                        </a>
                        <a href="{{ route('decreaseqty', $cart->id) }}" class="decreaseqty" data-rowId="{{ $cart->rowId }}" data-id="{{ $cart->id }}" title="Giảm số lượng">
                            <i class="fa fas fa-minus-circle"></i>
                        </a>
                        <a href="{{ route('deletecart', $cart->id) }}" data-id="{{ $cart->id }}" class="removerow" title="Xóa sản phẩm">
                            <i class="fa fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-md-4 col-md-offset-8">
        <table class="table table-bordered cart-table-2">
            <tr>
                <th>Tổng số tiền</th>
                <td><span id="sum_price_old">{{ format_money($sum_price_old) }}</span> VND</td>
            </tr>
            <tr>
                <th>Tổng số lượng</th>
                <td><span id="total_qty">{{ $count }}</span></td>
            </tr>
            <tr>
                <th>Giảm giá</th>
                <td><span id="sum_sale">{{ format_money($sum_sale) }}</span> VND</td>
            </tr>
            <tr class="row-total">
                <th>Thành tiền</th>
                <td><span id="subtotal">{{ $total }}</span> VND</td>
            </tr>
            <tr>
                <td class="cart-2-action" colspan="2"><a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
                <a href="{{ route('showtransaction') }}" class="btn btn-success">Thanh toán</a></td>
            </tr>
        </table>
    </div>
</div>
@stop