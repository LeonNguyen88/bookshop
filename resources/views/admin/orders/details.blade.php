@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Chi tiết đơn hàng</h1>
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Giá tiền</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
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
            </tr>
        @endforeach
        </tbody>
    </table>
@stop