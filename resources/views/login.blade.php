@extends('layout.mainlayout')

@section('name', 'Login')
@section('content')
<main class="login-wrapper" style="background-image: url('{{ asset('img/logoWKM.jpg') }}')">
    <div class="login-overlay d-flex align-items-center justify-content-center min-vh-100 p-4">
        
        <div class="card login-card shadow-lg" style="max-width: 28rem;">
            <div class="card-body p-4 p-md-5">

                <div class="text-center mb-4">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/logoWKM.png') }}" alt="WKM Logo" class="login-logo">
                    </a>
                </div>

                <ul class="nav nav-tabs nav-fill" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-pane" type="button" role="tab" aria-controls="login-pane" aria-selected="true">
                            Login
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register-pane" type="button" role="tab" aria-controls="register-pane" aria-selected="false">
                            Register
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="authTabsContent">

                    <div class="tab-pane fade show active" id="login-pane" role="tabpanel" aria-labelledby="login-tab">
                        <h1 class="h3 fw-bold text-white text-center mb-4">Login</h1>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label text-white fw-bold">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-dark" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label text-white fw-bold">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-dark" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gold btn-lg fw-bold">Login</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="register-pane" role="tabpanel" aria-labelledby="register-tab">
                        <h1 class="h3 fw-bold text-white text-center mb-4">Create Account</h1>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label text-white fw-bold">Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-dark" required>
                            </div>
                            <div class="mb-3">
                                <label for="reg_email" class="form-label text-white fw-bold">Email</label>
                                <input type="email" id="reg_email" name="email" class="form-control form-control-dark" required>
                            </div>
                            <div class="mb-4">
                                <label for="reg_password" class="form-label text-white fw-bold">Password</label>
                                <input type="password" id="reg_password" name="password" class="form-control form-control-dark" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gold btn-lg fw-bold">Register</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</main>
@endsection