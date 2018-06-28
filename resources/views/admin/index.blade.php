@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $comment }}</div>
                            <div>Bình luận mới!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.comment.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $product }}</div>
                            <div>Sản phẩm mới!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.product.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $order }}</div>
                            <div>Đơn hàng mới!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.order.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $user }}</div>
                            <div>Người dùng mới!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <h2 class="page-header">Thống kê sản phẩm</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Tổng sản phẩm</th>
            <th>Số lượng sản phẩm còn hàng</th>
            <th>Top 3 sản phẩm bán chạy nhất</th>
            <th>Số lượng sản phẩm đã được đặt mua</th>
        </tr>
        </thead>
        <tbody>
            <td>{{ $total_pro }}</td>
            <td>{{ $avai_pro }}</td>
            <td>
                @foreach($hot_products as $hot_product)
                    {{ $hot_product->name }},
                @endforeach
            </td>
            <td>{{ $ordered_pro }}</td>
        </tbody>
    </table>
    <h2 class="page-header">Thống kê đơn hàng</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Tổng đơn hàng</th>
            <th>Số lượng đơn hàng chưa giao</th>
            <th>Số lượng đơn hàng đã giao</th>
            <th>Số lượng đơn hàng đang giao</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $total_ord }}</td>
                <td>{{ $not_ord }}</td>
                <td>{{ $al_ord }}</td>
                <td>{{ $ing_ord }}</td>
            </tr>
        </tbody>
    </table>
    <h2 class="page-header">Thống kê khác</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Tổng số lượng người dùng</th>
            <th>Tổng số lượng đánh giá</th>
            <th>Tổng số lượng bình luận</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $total_user }}</td>
            <td>{{ $total_review }}</td>
            <td>{{ $total_cmt }}</td>
        </tr>
        </tbody>
    </table>
@stop