@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Danh sách chuyên mục</h1>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Chuyên mục cha</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent_id != 0 ? $category->toName($category->parent_id) : 'Không' }}</td>
                <td>{{ $category->created_at->format('H:i:s d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-success">Sửa</a>
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoryController@destroy', $category->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger', 'name' => 'delete-category', 'onclick' => 'return delete_category();']) !!}
                        </div>
                        {{ csrf_field() }}
                    {!! Form::close() !!}
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-6 col-md-offset-5">
            {{ $categories->render() }}
        </div>
    </div>
@stop
@section('footer')
    <style>
        form, .form-group{
            display: inline;
        }
    </style>
    <script>
        function delete_category(){
            if(confirm('Bạn có chắc chắn xóa chuyên mục này không ?')){
                return true;
            }
            else return false;
        }
    </script>
@stop