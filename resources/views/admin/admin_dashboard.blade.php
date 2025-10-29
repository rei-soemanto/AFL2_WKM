@extends('layout.mainlayout')

@section('name', 'Admin Dashboard')
@section('content')
<main class="main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="bg-overlay min-vh-100 py-5">
        <div class="container-xl py-5">
            <h1 class="display-4 fw-bold text-center mb-4 text-white">Admin Dashboard</h1>
            <p class="text-center text-white-50 mb-5 fs-5">Welcome, {{ $admin_username }}!</p>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

                <div class="col">
                    <div class="card card-translucent shadow-lg h-100">
                        <div class="card-body p-4">
                            <h2 class="h5 card-title fw-bold text-dark">Total Products</h2>
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <span class="h2 fw-bold text-dark">{{ $product_count }}</span>
                                <a href="{{ url('/admin/products') }}" class="btn btn-gold fw-bold">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-translucent shadow-lg h-100">
                        <div class="card-body p-4">
                            <h2 class="h5 card-title fw-bold text-dark">Total Services</h2>
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <span class="h2 fw-bold text-dark">{{ $service_count }}</span>
                                <a href="{{ url('/admin/services') }}" class="btn btn-gold fw-bold">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-translucent shadow-lg h-100">
                        <div class="card-body p-4">
                            <h2 class="h5 card-title fw-bold text-dark">Total Projects</h2>
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <span class="h2 fw-bold text-dark">{{ $project_count }}</span>
                                <a href="{{ url('/admin/projects') }}" class="btn btn-gold fw-bold">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-translucent shadow-lg h-100">
                        <div class="card-body p-4">
                            <h2 class="h5 card-title fw-bold text-dark mb-4">Quick Actions</h2>
                            <div class="d-grid gap-3">
                                <a href="{{ url('/admin/products/create') }}" class="btn btn-primary fw-bold">Add Product</a>
                                <a href="{{ url('/admin/services/create') }}" class="btn btn-success fw-bold">Add Service</a>
                                <a href="{{ url('/admin/projects/create') }}" class="btn btn-purple fw-bold">Add Project</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection