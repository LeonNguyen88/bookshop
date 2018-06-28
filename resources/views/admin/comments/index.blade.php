@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Danh sách bình luận</h1>
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Người bình luận</th>
            <th>Nội dung</th>
            <th>Thời gian bình luận</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->created_at->format('H:i:s d/m/Y') }}</td>
                <td>
                    <a href="{{ route('product', $comment->product_id) }}" target="_blank" class="btn btn-success">Xem</a>
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCommentController@destroy', $comment->id]]) !!}
                    <div class="form-group">
                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger', 'name' => 'delete-comment', 'onclick' => 'return delete_comment();']) !!}
                    </div>
                    {{ csrf_field() }}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('footer')
    <style>
        form, .form-group{
            display: inline;
        }
    </style>
    <script>
        function delete_comment(){
            if(confirm('Bạn có chắc chắn xóa bình luận này không ?')){
                return true;
            }
            else return false;
        }
    </script>
@stop