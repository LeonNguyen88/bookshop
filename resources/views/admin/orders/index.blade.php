@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Danh sách đơn hàng</h1>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Tổng tiền</th>
                <th>Số lượng</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->realname }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
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
                        <a href="{{ route('admin.order.detail', $order->id) }}" class="btn btn-primary">Chi tiết</a>
                        <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-success">Cập nhật trạng thái</a>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminOrderController@destroy', $order->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger', 'name' => 'delete-order', 'onclick' => 'return delete_order();']) !!}
                        </div>
                        {{ csrf_field() }}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
@section('footer')
    <script>
        function delete_order(){
            if(confirm('Bạn có chắc chắn xóa đơn hàng này không ?')){
                return true;
            }
            else return false;
        }
    </script>
@stop