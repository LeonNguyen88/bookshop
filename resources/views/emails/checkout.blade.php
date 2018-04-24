<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<p>Sachngoaivan.com rất vui thông báo đơn hàng số #{{ $orders->id }} của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Sachngoaivan sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
<p>Thông tin về đơn hàng:</p>
<table class="table">
    <thead>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders->orders_detail as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ format_money($item->price) }} VND</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ format_money($item->price * $item->quantity) }} VND</td>
        </tr>
    @endforeach
    </tbody>
</table>
<p style="color: red; font-size: 20px; font-weight: bold">Tổng số lượng sản phẩm trong đơn hàng: {{ $orders->quantity }}</p>
<p style="color: red; font-size: 20px; font-weight: bold">Tổng tiền của đơn hàng: {{ format_money($orders->total) }} VND</p>
<p>Quý khách có thể hủy đơn hàng trước khi đơn hàng này được đóng gói.</p>
<p>Xin cảm ơn quý khách.</p>
<h3>SACHNGOAIVAN.COM</h3>
</body>
</html>