@extends('layouts.front-end2')

@section('content')
    <h2 class="title-header">CHI TIẾT ĐƠN HÀNG</h2>
    <div style="clear: left"></div>
    <table class="table">
        <thead>
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->product->id }}</td>
                <td>{{ $order->product->name }}</td>
                <td>
                    @foreach($order->product->photo as $photo)
                        @if($photo->is_cover == 1)
                            <img src="{{ $photo->photo_url }}" width="72" />
                        @endif
                    @endforeach
                </td>
                <td>{{ format_money($order->price) }} VND</td>
                <td>{{ $order->quantity }}</td>
                <td>
                    @if($order->status == "Chưa giao hàng")
                        <span style = "color: red">{{ $order->status }}</span>
                    @elseif($order->status == "Đang giao hàng")
                        <span style = "color: #337ab7">{{ $order->status }}</span>
                    @else
                        <span style = "color: #5cb85c">{{ $order->status }}</span>
                    @endif
                </td>
                <td>
                    {{ format_money($order->price * $order->quantity) }} VND
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop