@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Tạo sản phẩm</h1>
    <div class="col-md-10">
        {!! Form::open(['method' => 'POST', 'action' => 'AdminProductController@store', 'files' => true ]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Tên sản phẩm: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Danh mục: ') !!}
            {!! Form::select('category_id[]', $category, null, ['multiple' => true, 'class' => 'form-control', 'required' => 'required', 'size' => 10]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('author', 'Tác giả: ') !!}
            {!! Form::text('author', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cover_url', 'Ảnh bìa: ') !!}
            {!! Form::file('cover_url', ['required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_url', 'Ảnh phụ: ') !!}
            {!! Form::file('photo_url[]', ['multiple']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price', 'Giá gốc sản phẩm: ') !!}
            {!! Form::number('price', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sale', 'Giảm giá: ') !!}
            {!! Form::number('sale', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('quantity', 'Số lượng: ') !!}
            {!! Form::number('quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Mô tả: ') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '10', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('issuer', 'Công ty phát hành: ') !!}
            {!! Form::text('issuer', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('publisher', 'Nhà xuất bản: ') !!}
            {!! Form::text('publisher', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('size', 'Kích thước: ') !!}
            {!! Form::text('size', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cover', 'Loại bìa: ') !!}
            {!! Form::text('cover', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('num_page', 'Số trang: ') !!}
            {!! Form::number('num_page', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Tình trạng: ') !!}
            {!! Form::text('status', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('date_publish', 'Ngày xuất bản: ') !!}
            {!! Form::text('date_publish', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Tạo sản phẩm', ['class' => 'btn btn-primary', 'name' => 'create-product']) !!}
        </div>
        {{ csrf_field() }}
        {!! Form::close() !!}
    </div>
@stop