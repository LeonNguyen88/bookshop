@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Danh sách tài khoản</h1>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên tài khoản</th>
                <th>Họ và tên</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Cấp độ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->realname }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucwords($user->role->name) }}</td>
                    <td>
                        <a href="{{ route('admin.users.promote', $user->id) }}" class="btn btn-success">Thăng cấp</a>
                        <a href="{{ route('admin.users.demote', $user->id) }}" class="btn btn-warning">Giáng cấp</a>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUserController@destroy', $user->id ]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger', 'name' => 'delete-user', 'onclick' => 'return delete_user();']) !!}
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
            {{ $users->render() }}
        </div>
    </div>
@stop

@section('footer')
    <script>
        function delete_user(){
            if(confirm('Bạn có chắc chắn xóa tài khoản này không ?')){
                return true;
            }
            else return false;
        }
    </script>
    @stop