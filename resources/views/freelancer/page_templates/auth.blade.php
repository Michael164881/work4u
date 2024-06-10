<div class="wrapper">

    @include('freelancer.navbars.auth')

    <div class="main-panel">
        @include('freelancer.navbars.navs.auth')
        @yield('content')
        @include('freelancer.footer')
    </div>
</div>