<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">صفحات</div>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    داشبورد
                </a>
                <a class="nav-link" href="{{ route('add.student') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                    افزودن دانش آموز
                </a>
                <a class="nav-link" href="{{ route('dashboard.students') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                    دانش آموزان
                </a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                    خروج
                </a>
                <form action="{{ route('logout') }}" id="logout_form" method="POST">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </nav>
</div>
