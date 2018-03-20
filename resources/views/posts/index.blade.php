@extends('layouts.app')

@section('content')
    <ul>
        @foreach($post as $item)
            <li><a href="{{ route('posts.show', $item->id) }}">{{ $item->title }}</a></li>
            @endforeach
    </ul>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $post->render() }}
        </div>
    </div>
@endsection