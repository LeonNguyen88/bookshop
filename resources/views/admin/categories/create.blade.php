@extends('layouts.admin')

@section('content')
    <h1>Tạo chuyên mục</h1>
    <div class="col-md-6">
        {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoryController@store' ]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Tên chuyên mục: ') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('parent_id', 'Chuyên mục cha: ') !!}
                {!! Form::select('parent_id', ['0' => 'Không'] + $category, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Tạo', ['class' => 'btn btn-primary', 'name' => 'create-category']) !!}
            </div>
            {{ csrf_field() }}
        {!! Form::close() !!}
    </div>
@stop
