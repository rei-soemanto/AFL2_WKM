<nav class="navbar navbar-dark navbar-custom px-4 py-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        
        <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('img/logoWKM.png') }}" alt="WKM Logo" class="navbar-logo">
        </a>

        <ul class="navbar-nav flex-row mx-auto">
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ url('/') }}">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ url('/project') }}">Project</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ url('/product') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ url('/service') }}">Service</a>
            </li>
        </ul>

        <a href="#contact" class="btn btn-custom fw-bold text-nowrap">
            Contact Us
        </a>

    </div>
</nav>