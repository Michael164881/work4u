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
            <li class="nav-item {{ $elementActive == 'home' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'home') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p class="nav-text">{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'cancel' ? 'active' : '' }}">
                <a href="{{ route('cancel.index', 'cancel') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p class="nav-text">{{ __('Cancelation') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'users' ? 'active' : '' }}">
                <a href="{{ route('users.index', 'users') }}"> 
                    <i class="nc-icon nc-settings"></i>
                    <p class="nav-text">{{ __('User Management') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'freelancers' ? 'active' : '' }}">
                <a href="{{ route('freelancers.index', 'freelancers') }}"> 
                    <i class="nc-icon nc-settings"></i>
                    <p class="nav-text">{{ __('Freelancer') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $elementActive == 'job' ? 'active' : '' }}">
                <a href="{{ route('job.index', 'job') }}"> 
                    <i class="nc-icon nc-settings"></i>
                    <p class="nav-text">{{ __('Work/Job') }}</p>
                </a>
            </li>
            <!-- <li class="nav-item {{ $elementActive == 'statistic' ? 'active' : '' }}">
                <a href="{{ route('statistic.index', 'statistic') }}">
                    <i class="nc-icon nc-bookmark-2"></i>
                    <p class="nav-text">{{ __('Statistic') }}</p>
                </a>
            </li> -->
            <li class="nav-item {{ $elementActive == 'statistic' ? 'active' : '' }}">
                <a href="{{ route('statistic.index', 'statistic') }}">
                    <i class="nc-icon nc-circle-10"></i>
                    <p class="nav-text">{{ __('Statistic') }}</p>
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