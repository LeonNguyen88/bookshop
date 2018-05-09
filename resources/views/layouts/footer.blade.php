<div class="row footer-top">
    <div class="container">
        <div class="col-md-3">
            <img src="{{ asset('images/shipping-icon.png') }}" width="70" class="footer-top-icon" />
            <h3 class="footer-top-title">GIAO HÀNG</h3>
            <div class="footer-top-content">Nhanh chóng, tận nơi, miễn phí toàn quốc</div>
        </div>
        <div class="col-md-3">
            <img src="{{ asset('images/dollar_money_cash_investment-512.png') }}" width="70" class="footer-top-icon" />
            <h3 class="footer-top-title">GIÁ CẢ</h3>
            <div class="footer-top-content">Cực rẻ với nhiều khuyến mãi bất ngờ</div>
        </div>
        <div class="col-md-3">
            <img src="{{ asset('images/book-stack-icon.png') }}" width="70" class="footer-top-icon" />
            <h3 class="footer-top-title">KHO SÁCH</h3>
            <div class="footer-top-content">Phong phú, đa dạng nhiều thể loại</div>
        </div>
        <div class="col-md-3">
            <img src="{{ asset('images/exchange.png') }}" width="70" class="footer-top-icon" />
            <h3 class="footer-top-title">UY TÍN</h3>
            <div class="footer-top-content">Dễ dàng đổi trả trong 1 tuần</div>
        </div>
    </div>
</div>
<div class="row footer-bot">
    <div class="container">
        <div class="col-md-4">
            <h4>VỀ CHÚNG TÔI</h4>
            <ul class="list-footer">
                <li>Giới thiệu</li>
                <li>Quy trình đặt sách</li>
                <li>Hướng dẫn thanh toán</li>
                <li>Chính sách đổi trả</li>
                <li>Tuyển dụng</li>

            </ul>
        </div>
        <div class="col-md-4 footer-col-center">
            <a href="" class="logo-footer"></a>
            <p>© 2017-2018 Sachngoaivan - Designed by Leon Nguyen</p>
            <ul class="social-icon">
                <li><a href="index.php"><img src="{{ asset('images/facebook_circle-512.png') }}" /></a></li>
                <li><a href="index.php"><img src="{{ asset('images/google-plus-icon.png') }}" /></a></li>
                <li><a href="index.php"><img src="{{ asset('images/twitterbird.png') }}" /></a></li>
                <li><a href="index.php"><img src="{{ asset('images/Email-Sig-Icon-Instagram.png') }}" /></a></li>
            </ul>
        </div>
        <div class="col-md-4 footer-col-right">
            <h4>LIÊN HỆ</h4>
            <ul class="list-footer">
                <li>Công ty TNHH Sachngoaivan.com</li>
                <li>Khu phố 6, P.Linh Trung, Q.Thủ Đức, Tp.Hồ Chí Minh</li>
                <li>Hotline: 0120 549 1108</li>
                <li>Email: sachngoaivan.com@gmail.com</li>
            </ul>
        </div>
    </div>
</div>
<!-- Scripts -->
<!-- js --->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
@yield('js')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>