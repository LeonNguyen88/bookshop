@extends('layouts.app')
@section('content')
    <h1>Edit Post</h1>
    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostsController@update', $post->id]]) !!}
    {{ csrf_field() }}
        <div class="form-group">
            {!! Form::label('label_title', 'Post Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update', ['name' => 'edit-submit', 'class' => 'btn btn-info']) !!}
        </div>
    {!! Form::close() !!}
    {!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete', ['name' => 'delete-submit', 'class' => 'btn btn-alert']) !!}
        </div>
    {!! Form::close() !!}

@endsection

