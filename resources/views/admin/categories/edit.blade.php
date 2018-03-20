@extends('layouts.admin')

@section('content')
    <h1>Chỉnh sửa chuyên mục</h1>
    <div class="col-md-6">
        {!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoryController@update', $category->id ]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Tên chuyên mục: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('parent_id', 'Chuyên mục cha: ') !!}
            {!! Form::select('parent_id', ['0' => 'Không'] + $list_category, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary', 'name' => 'edit-category']) !!}
        </div>
        {{ csrf_field() }}
        {!! Form::close() !!}
    </div>
@stop
