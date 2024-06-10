<div class="wrapper">

    @include('customer.navbars.auth')

    <div class="main-panel">
        @include('customer.navbars.navs.auth')
        @yield('content')
        @include('customer.footer')
    </div>
</div>