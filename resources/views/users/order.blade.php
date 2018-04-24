@extends('layouts.front-end2')

@section('content')
    <h2 class="title-header">LỊCH SỬ MUA HÀNG</h2>
    <div style="clear: left"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tổng tiền</th>
                <th>Số lượng</th>
                <th>Thời gian đặt</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ format_money($order->total) }} VND</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->created_at->format('H:i:s d/m/Y') }}</td>
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
                        <a href="{{ route('orderdetail', $order->id) }}" class="btn btn-primary">Chi tiết</a>
                        @if($order->status == "Chưa giao hàng")
                            {!! Form::open(['method' => 'DELETE', 'action' => ['UserController@removeorder', $order->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Hủy', ['class' => 'btn btn-danger', 'name' => 'delete-order']) !!}
                            </div>
                            {{ csrf_field() }}
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop