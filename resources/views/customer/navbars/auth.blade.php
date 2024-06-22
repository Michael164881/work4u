<style>
    .active{
        background-color: #7C638F;
    }

    .active .nav-text{
        color: white;
    }

    .nav-item{
        margin: 5% 0 5% 0;
        height: 10vh;
        padding: 5% 0 5% 0;
    }

    .sidebar{
        padding: 0 0 10% 0;
    }
</style>

<div class="sidebar" data-color="white" data-active-color="danger">
<img src="{{ asset('images/work4u.png') }}" alt="Work4U Logo" class="logo">
    
<div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('pageCust.index', 'dashboard') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p class="nav-text">{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('pageCust.index', 'icons') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p class="nav-text">{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('pageCustMap.index', 'map') }}">
                    <i class="nc-icon nc-settings"></i>
                    <p class="nav-text">{{ __('Jobs') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('pageCust.index', 'notifications') }}">
                    <i class="nc-icon nc-bookmark-2"></i>
                    <p class="nav-text">{{ __('Booking') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'profile' ? 'active' : '' }}">
                <a href="{{ route('pageCust.index', 'edit') }}">
                    <i class="nc-icon nc-circle-10"></i>
                    <p class="nav-text">{{ __(' User Profile ') }}</p>
                </a>
            </li>
            
        </ul>
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const navItems = document.querySelectorAll('.nav-item');

            navItems.forEach(item => {
                item.addEventListener('click', function () {
                    navItems.forEach(navItem => navItem.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
</script>