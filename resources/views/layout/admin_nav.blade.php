<nav class="navbar navbar-dark navbar-custom">
    <div class="container-fluid row
        align-items-center p-0
    ">

        {{--
        * ====================
        * Logo
        * ====================
        --}}
        <a class="navbar-brand col-auto
        flex-shrink-0 me-3
        navbar-side
        " href="{{ url('/') }}">
            
            <img src="{{ asset('img/logoWKM.png') }}" alt="WKM Logo" class="navbar-logo">
        </a>

        {{--
        * ====================
        * Links to dashboard (Only for MD to XL)
        * ====================
        --}}
        <ul class="
            navbar-nav col
            d-none d-lg-flex position-absolute
            flex-row flex-grow-1 
            justify-content-center 
            fw-bold text-center
            mx-auto 
        ">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.list') }}">
                    User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.projects.list') }}">
                    Portfolio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.products.list') }}">
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.services.list') }}">
                    Services
                </a>
            </li>

        </ul>


        {{--
        * ====================
        * Name and Dropdown
        * ====================
        --}}
        @auth
            <div class="
                nav-item dropdown col-auto
                flex-shrink-1 
                text-end
                navbar-side
            ">

                <a class="nav-link dropdown-toggle fw-bold" 
                    href="#" id="navbarDropdown" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false">

                    <span class="username-text">
                        Admin, {{ Auth::user()->name }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ url('/') }}">
                            User View
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </a>
                        </form>
                    </li>
                </ul>

            </div>
        @endauth
    </div>


    {{-- 
    * ====================
    * Nav for below LG
    * ====================
    --}}

    {{-- Line and button --}}
    <div class="w-100 d-lg-none">
        <hr class="custom-divider mt-0"> 
        
        <div class="text-center py-2">
            <button class="btn btn-link custom-arrow-toggle" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#navLinksCollapse" 
                    aria-expanded="false" 
                    aria-controls="navLinksCollapse">
                    <i class="bi bi-caret-down-fill"></i>
                </button>
        </div>
    </div>

    {{-- Content of nav when button is pressed --}}
    <div class="collapse navbar-collapse" id="navLinksCollapse">
        <ul class="navbar-nav 
                    flex-column flex-sm-row 
                    align-items-center justify-content-center 
                    mb-0 mx-auto w-100 custom-nav-xs">
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ route('admin.users.list') }}">User</a>
                </li>
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ route('admin.projects.list') }}">Portfolio</a>
                </li>
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ route('admin.products.list') }}">Products</a>
                </li>
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ route('admin.services.list') }}">Services</a>
                </li>
            </ul>
    </div>
</nav>