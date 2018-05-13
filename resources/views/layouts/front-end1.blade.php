@include('layouts.header')
<div class="container">
    @yield('slider')
</div>
<div class="container">
    @yield('content')

    @include('layouts.sidebar')
</div>
@include('layouts.footer')
