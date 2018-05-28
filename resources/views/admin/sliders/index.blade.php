@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Danh sách Slider</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><h4>Trang chủ</h4></td>
                <td>
                    <a href="{{ route('admin.slider.create', 0) }}" class="btn btn-primary">Tạo mới</a>
                    <a href="" class="btn btn-success">Sửa</a>
                    <a href="" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td><h4>{{ $category->name }}</h4></td>
                    <td>
                        <a href="{{ route('admin.slider.create', $category->id) }}" class="btn btn-primary">Tạo mới</a>
                        <a href="" class="btn btn-success">Sửa</a>
                        <a href="" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@stop