@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Danh sách Slider</h1>
    <h4><a href="">Trang chủ</a></h4>
    @foreach($categories as $category)
        <h4><a href="">{{ $category->name }}</a></h4>
    @endforeach
@stop