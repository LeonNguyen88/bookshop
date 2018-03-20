@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Chỉnh sửa sản phẩm</h1>
    <div class="col-md-10">
        {!! Form::model($product, ['method' => 'PATCH', 'action' => ['AdminProductController@update', $product->id], 'files' => true ]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Tên sản phẩm: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Danh mục: ') !!}
            {!! Form::select('category_id[]', $category, $product->category, ['multiple' => true, 'class' => 'form-control', 'required' => 'required', 'size' => 10]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('author', 'Tác giả: ') !!}
            {!! Form::text('author', $product->product_detail->author, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label(null, 'Ảnh bìa cũ: ') !!}
            <img src="{{ $product->photo->photo_url }}" width="150" />
        </div>
        <div class="form-group">
            {!! Form::label('photo_url', 'Ảnh bìa mới: ') !!}
            {!! Form::file('photo_url') !!}
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
            {!! Form::text('issuer', $product->product_detail->issuer, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('publisher', 'Nhà xuất bản: ') !!}
            {!! Form::text('publisher', $product->product_detail->publisher, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('size', 'Kích thước: ') !!}
            {!! Form::text('size', $product->product_detail->size, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cover', 'Loại bìa: ') !!}
            {!! Form::text('cover', $product->product_detail->cover, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('num_page', 'Số trang: ') !!}
            {!! Form::text('num_page', $product->product_detail->num_page, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Tình trạng: ') !!}
            {!! Form::text('status', $product->product_detail->status, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('date_publish', 'Ngày xuất bản: ') !!}
            {!! Form::text('date_publish', $product->product_detail->date_publish, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary', 'name' => 'update-product']) !!}
        </div>
        {{ csrf_field() }}
        {!! Form::close() !!}
    </div>
@stop