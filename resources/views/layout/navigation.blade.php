<nav class="navbar navbar-dark navbar-custom">
    <div class="container-fluid d-flex flex-nowrap align-items-center justify-content-between">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logoWKM.png') }}" alt="WKM Logo" class="navbar-logo">
        </a>

        <!-- Nav links (MD - XL) -->
        <ul class="navbar-nav d-none d-md-flex flex-row align-items-center">
            <li class="nav-item mx-1"><a class="nav-link" href="{{ url('/') }}">About</a></li>
            <li class="nav-item mx-1"><a class="nav-link" href="{{ url('/project') }}">Portfolio</a></li>
            <li class="nav-item mx-1"><a class="nav-link" href="{{ url('/product') }}">Products</a></li>
            <li class="nav-item mx-1"><a class="nav-link" href="{{ url('/service') }}">Services</a></li>
        </ul>

        <!-- Contact -->
        <a href="#contact" class="btn btn-custom fw-semibold text-nowrap">
            Contact Us
        </a>
    </div>

    <!-- Line and button (XS - SM) -->
    <div class="w-100 d-md-none">
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

    <div class="collapse navbar-collapse d-md-none" id="navLinksCollapse">
        <div class="container-fluid">
            <ul class="navbar-nav 
                       flex-column flex-sm-row 
                       align-items-center justify-content-center 
                       mb-0 mx-auto w-100 custom-nav-xs">
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ url('/') }}">About</a>
                </li>
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ url('/project') }}">Portfolio</a>
                </li>
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ url('/product') }}">Products</a>
                </li>
                <li class="nav-item mx-sm-1 py-2">
                    <a class="nav-link" href="{{ url('/service') }}">Services</a>
                </li>
            </ul>
        </div>
    </div>
</nav>