@extends('layouts.front-end2')

@section('content')
        <h2 class="title-header">THÔNG TIN ĐƠN HÀNG</h2>
        <table class="table table-bordered order-info-table">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Hình sản phẩm</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ $product->options->image }}" width="100" /></td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ format_money($product->qty * $product->price) }} VND</td>
                    </tr>
                @endforeach
                <tr class="row-total">
                    <td colspan="3">Tổng tiền đơn hàng</td>
                    <td>{{ $total }} VND</td>
                </tr>
            </tbody>
        </table>
        <h2 class="title-header">THÔNG TIN GIAO HÀNG</h2>
        <div style="clear: left"></div>
        <div class="col-md-8 col-md-offset-2">
            {!! Form::model($user, ['method' => 'POST', 'action' => 'TransactionController@store' ]) !!}
            <div class="form-group{{ $errors->has('realname') ? ' has-error' : '' }}">
                {!! Form::label('realname', 'Họ và tên: ') !!}
                {!! Form::text('realname', null, ['class' => 'form-control']) !!}
                @if ($errors->has('realname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('realname') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                {!! Form::label('address', 'Địa chỉ giao hàng: ') !!}
                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                {!! Form::label('phone', 'Số điện thoại liên hệ: ') !!}
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {!! Form::submit('Đặt mua', ['class' => 'btn btn-primary', 'name' => 'transaction-submit']) !!}
            </div>
            {{ csrf_field() }}
            {!! Form::close() !!}
        </div>
@stop