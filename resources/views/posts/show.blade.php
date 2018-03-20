@extends('layouts.app')

@section('content')
    <h1><a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a></h1>
    <img src="{{ $post->path }}" width="600" />
@endsection