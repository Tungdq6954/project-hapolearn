<header id="header" class="container-fluid position-relative p-0 header">
    <nav class="navbar navbar-expand-sm p-sm-0 navbar-light custom-navbar">
        <a class="navbar-brand custom-navbar-brand" href="#">
            <img src="{{ asset('img/hapo_Learn.png') }}" alt="Hapo_Learn">
        </a>
        <button class="navbar-toggler custom-button-navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times hidden"></i>
        </button>

        <div class="collapse navbar-collapse custom-navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 d-flex justify-content-end">
                @guest
                <li class="nav-item active">
                    <a class="nav-link text-secondary active" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">ALL COURSES</a>
                </li>
                <li class="nav-item addition-class hidden">
                    <a class="nav-link text-secondary" href="#">LIST LESSON</a>
                </li>
                <li class="nav-item addition-class hidden">
                    <a class="nav-link text-secondary" href="#">LESSON DETAIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#" data-toggle="modal" data-target="#login-register">LOGIN/REGISTER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">PROFILE</a>
                </li>
                @else
                <li class="nav-item active">
                    <a class="nav-link text-secondary active" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">ALL COURSES</a>
                </li>
                <li class="nav-item addition-class hidden">
                    <a class="nav-link text-secondary" href="#">LIST LESSON</a>
                </li>
                <li class="nav-item addition-class hidden">
                    <a class="nav-link text-secondary" href="#">LESSON DETAIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">PROFILE</a>
                </li>
                <li class="nav-item">
                    <a id="logout-nav" class="nav-link text-secondary" href="{{ route('logout') }}">LOGOUT</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
@include('auth.login_register')
