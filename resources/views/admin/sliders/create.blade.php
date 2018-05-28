@extends('layouts.admin')

@section('content')
    <h1 class="page-header">{{ $name }}</h1>
    <div class="col-md-10">
        {!! Form::open(['method' => 'POST', 'action' => 'AdminSliderController@store', 'files' => true ]) !!}
        <div id="slider-container">
            <div class="slider-item">
                <div class="form-group">
                    {!! Form::label('photo_url', 'Hình ảnh: ') !!}
                    {!! Form::file('photo_url[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('link', 'Đường dẫn: ') !!}
                    {!! Form::text('link[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('order', 'Thứ tự: ') !!}
                    {!! Form::text('order[]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
        </div>
        <a href="" class="btn btn-success add-slider-btn" style="margin: 30px 0; border-bottom: 1px solid #8c8c8c;">Thêm hình mới</a>
        <div class="divider"></div>
        <div class="form-group">
            {!! Form::submit('Tạo sản phẩm', ['class' => 'btn btn-primary', 'name' => 'create-product']) !!}
        </div>
        {{ csrf_field() }}
        {!! Form::close() !!}
    </div>
@stop
@section('custom-css')
    <style type="text/css">
            .slider-item{
                border: 1px solid #8c8c8c;
                padding: 20px;
                margin-bottom: 20px;
            }
        .divider{
            border: 1px solid #eee;
            margin-bottom: 30px;
        }
    </style>
@stop
@section('footer')
    <script src="{{ asset('js/myscript.js') }}"></script>
@stop