<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="@if(auth()->user()->type == 'admin'){{ route('home') }}@else{{ route('users.dashboard') }}@endif">{{ env('APP_NAME') }}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            @if(empty(auth()->user()->image))
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            @else
                <img src="{{ asset('images/students_images/' . auth()->user()->image) }}" style="width: 45px; height: 45px;">
            @endif
        </li>
    </ul>
</nav>
