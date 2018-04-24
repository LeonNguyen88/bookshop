@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Danh sách sản phẩm</h1>
    <table class="table">
        <thead>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Chuyên mục</th>
            <th>Giá tiền</th>
            <th>Giá gốc</th>
            <th>Khuyến mãi</th>
            <th>Số lượng</th>
            <th>Hành động</th>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><a href="{{ route('product', $product->id) }}" target="_blank">{{ $product->name }}</a></td>
                    <td><img src="{{ $product->photo->photo_url }}" width="72" /></td>
                    <td>
                        @if(count($product->category) > 1)
                            <ul class="category-list">
                                @foreach($product->category as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            @foreach($product->category as $category)
                                {{ $category->name }}
                            @endforeach
                        @endif
                    </td>
                    <td>{{ number_format($product->price - $product->sale, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($product->sale, 0, ',', '.') }} VND</td>
                    <td>
                        @if($product->quantity == 0)
                            <div style="color: red; font-weight: bold">{{ $product->quantity }}</div>
                        @else
                            {{ $product->quantity }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-success">Sửa</a>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminProductController@destroy', $product->id ]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger', 'name' => 'delete-product', 'onclick' => 'return delete_product();']) !!}
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
            {{ $products->render() }}
        </div>
    </div>
@stop

@section('footer')
    <style>
        .category-list{
            padding-left: 0 !important;
        }
    </style>
    <script>
        function delete_product(){
            if(confirm('Bạn có chắn chắn xóa sản phẩm này không ?')){
                return true;
            }
            else return false;
        }
    </script>
@stop