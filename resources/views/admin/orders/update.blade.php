@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Cập nhật trạng thái đơn hàng</h1>
    {!! Form::model($order, ['method' => 'PATCH', 'action' => ['AdminOrderController@update', $order->id]]) !!}
        <div class="form-group">
            {!! Form::radio('status', 'Chưa giao hàng', ['class' => 'form-control']) !!}
            {!! Form::label('status', 'Chưa giao hàng') !!}
        </div>
        <div class="form-group">
            {!! Form::radio('status', 'Đang giao hàng', ['class' => 'form-control']) !!}
            {!! Form::label('status', 'Đang giao hàng') !!}
        </div>
        <div class="form-group">
            {!! Form::radio('status', 'Đã giao hàng', ['class' => 'form-control']) !!}
            {!! Form::label('status', 'Đã giao hàng') !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary', 'name' => 'update-order']) !!}
        </div>
        {{ csrf_field() }}
    {!! Form::close() !!}

@stop