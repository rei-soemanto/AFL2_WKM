<nav class="navbar navbar-dark navbar-custom flex-column p-0 shadow">
    <div class="container-fluid row align-items-center g-0 px-3 py-2">
        <div class="col col-lg-3 d-flex justify-content-start">
            <a class="navbar-brand m-0" href="{{ url('/') }}">
                <img src="{{ asset('img/logoWKM.png') }}" alt="WKM Logo" class="navbar-logo">
            </a>
        </div>

        <div class="col-lg-6 d-none d-lg-flex justify-content-center">
            <ul class="navbar-nav flex-row fw-bold gap-2">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/project') }}">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/product') }}">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/service') }}">Services</a></li>
            </ul>
        </div>

        <div class="col col-lg-3 d-flex justify-content-end align-items-center">
            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold p-0" 
                        href="#" 
                        id="navbarDropdown" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        data-bs-display="static"
                        aria-expanded="false">
                        <span class="username-text">
                            Hello, {{ explode(' ', Auth::user()->name)[0] }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="navbarDropdown">    
                        @php
                            $isStaff = Auth::user()->userRole && in_array(Auth::user()->userRole->name, ['Admin', 'Manager', 'Employee']);
                        @endphp
                        <li>
                            <a class="dropdown-item" href="{{ $isStaff ? 'https://management.thewkm.com/projects' : route('user.interests') }}">
                                {{ $isStaff ? 'Management Panel' : 'My Interest List' }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Account Management</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-warning fw-bold px-4">Login</a>
            @endauth
        </div>
    </div>

    <div class="w-100 d-lg-none">
        <hr class="custom-divider"> 
        <div class="text-center py-2">
            <button class="btn btn-link custom-arrow-toggle p-0"
                    type="button"
                    id="mobileMenuToggle"
                    aria-expanded="false">
                <i class="bi bi-caret-down-fill"></i>
            </button>
        </div>

        <div class="mobile-menu-mask">
            <div class="mobile-slide-menu" id="mobileMenu">
                <div class="container pb-2">
                    <ul class="navbar-nav d-flex flex-column flex-md-row align-items-center justify-content-center text-center fw-bold">
                        <li class="nav-item w-100 w-md-auto"><a class="nav-link" href="{{ url('/') }}">About</a></li>
                        <li class="nav-item w-100 w-md-auto"><a class="nav-link" href="{{ url('/project') }}">Portfolio</a></li>
                        <li class="nav-item w-100 w-md-auto"><a class="nav-link" href="{{ url('/product') }}">Products</a></li>
                        <li class="nav-item w-100 w-md-auto"><a class="nav-link" href="{{ url('/service') }}">Services</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>