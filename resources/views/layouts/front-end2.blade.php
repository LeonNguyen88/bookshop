@include('layouts.header')
<div class="container">
        <div class="col-md-9 product-list">
        @yield('content')

        </div>
        @include('layouts.sidebar')
</div>
@include('layouts.footer')
