@extends('layouts.front-end2')

@section('content')
    <h2 class="title-header">THÔNG TIN TÀI KHOẢN</h2>
    <div style="clear: left"></div>
    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@updateaccount', $user->id]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Tên tài khoản: ') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'disabled']) !!}
    </div>
    <div class="form-group{{ $errors->has('realname') ? ' has-error' : '' }}">
        {!! Form::label('realname', 'Họ và tên: ') !!}
        {!! Form::text('realname', null, ['class' => 'form-control']) !!}
        @if ($errors->has('realname'))
            <span class="help-block">
                <strong>{{ $errors->first('realname') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email: ') !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'disabled']) !!}
    </div>
    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        {!! Form::label('address', 'Địa chỉ nhà: ') !!}
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        {!! Form::label('phone', 'Số điện thoại: ') !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::submit('Cập nhật', ['class' => 'btn btn-success', 'name' => 'update-account']) !!}
    </div>
    {{ csrf_field() }}
    {!! Form::close() !!}
@stop