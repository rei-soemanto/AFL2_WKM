@extends('layout.mainlayout')

@section('name', 'Admin Dashboard')
@section('content')

{{-- Background --}}
<main class="main-background" 
    style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">

    {{-- Background overlay to make it darker --}}
    <div class="bg-overlay min-vh-100 py-5">

        {{-- Container --}}
        <div class="container-xl py-5">

            {{--
            *
            *   SECTION 1: GREETINGS
            *
            --}}

            {{-- Admin dashboard title --}}
            <h1 class="
                display-4 fw-bold text-center text-white
                mb-4">
                Admin Dashboard
            </h1>

            {{-- Greetings from username --}}
            <p class="
                fs-5 text-center text-white-50
                mb-5 
            ">
                Welcome, {{ Auth::user()->name }}!
            </p>


            {{--
                *
                *   SECTION 2: DASHBOARD CARDS 
                *
            --}}

            {{-- Grid for dashboard cards --}}
            <div class="g-4 row row-cols-1 row-cols-md-2 row-cols-lg-5">

                {{-- 
                    *   Card 1: Total User Interest 
                --}}
                <div class="col">
                    <div class="
                        card shadow-lg
                        h-100
                        card-translucent 
                    ">
                        <div class="card-body p-4">

                            {{-- Title --}}
                            <h5 class="card-title
                                h5 fw-bold text-dark">Total User Interest</h5>

                            {{-- Container for Value --}}
                            <div class="
                                d-flex justify-content-between align-items-center 
                                mt-4
                            ">
                                
                                {{-- Value --}}
                                <span class="h2 fw-bold text-dark">
                                    {{ $user_count }}
                                </span>
                                
                                {{-- Manage Button --}}
                                <a href="{{ route('admin.users.list') }}"
                                    class="btn btn-gold fw-bold
                                ">
                                    Manage
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- 
                    *   Card 2: Total Products 
                --}}
                <div class="col">
                    <div class="
                        card shadow-lg
                        h-100
                        card-translucent
                    ">
                        <div class="card-body p-4">

                            {{-- Title --}}
                            <h5 class="card-title h5 fw-bold text-dark">
                                Total Products
                            </h5>

                            {{-- Container for Value --}}
                            <div class="
                                d-flex justify-content-between align-items-center
                                mt-4
                            ">

                                {{-- Value --}}
                                <span class="h2 fw-bold text-dark">
                                    {{ $product_count }}
                                </span>

                                {{-- Manage Button --}}
                                <a href="{{ route('admin.products.list') }}" class="btn btn-gold fw-bold">
                                    Manage
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- 
                    *   Card 3: Total Services 
                --}}
                <div class="col">
                    <div class="
                        card shadow-lg
                        h-100
                        card-translucent
                    ">
                        <div class="card-body p-4">

                            {{-- Title --}}
                            <h5 class="card-title h5 fw-bold text-dark">
                                Total Services
                            </h5>

                            {{-- Container for Value --}}
                            <div class="
                                d-flex justify-content-between align-items-center
                                mt-4
                            ">

                                {{-- Value --}}
                                <span class="h2 fw-bold text-dark">
                                    {{ $service_count }}
                                </span>

                                {{-- Manage Button --}}
                                <a href="{{ route('admin.services.list') }}" class="btn btn-gold fw-bold">
                                    Manage
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- 
                    *   Card 4: Total Projects 
                --}}
                <div class="col">
                    <div class="
                        card shadow-lg
                        h-100
                        card-translucent
                    ">
                        <div class="card-body p-4">

                            {{-- Title --}}
                            <h5 class="card-title h5 fw-bold text-dark">
                                Total Projects
                            </h5>

                            {{-- Container for Value --}}
                            <div class="
                                d-flex justify-content-between align-items-center
                                mt-4
                            ">

                                {{-- Value --}}
                                <span class="h2 fw-bold text-dark">
                                    {{ $project_count }}
                                </span>

                                {{-- Manage Button --}}
                                <a href="{{ route('admin.projects.list') }}" class="btn btn-gold fw-bold">
                                    Manage
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- 
                    *   Card 5: Quick Actions 
                --}}
                <div class="col">
                    <div class="
                        card shadow-lg
                        h-100
                        card-translucent
                    ">
                        <div class="card-body p-4">

                            {{-- Title --}}
                            <h5 class="card-title h5 fw-bold text-dark mb-4">
                                Quick Actions
                            </h5>

                            {{-- Buttons for quick actions --}}
                            <div class="d-grid gap-3">

                                {{-- Add Product --}}
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary fw-bold">
                                    Add Product
                                </a>

                                {{-- Add Service --}}
                                <a href="{{ route('admin.services.create') }}" class="btn btn-success fw-bold">
                                    Add Service
                                </a>

                                {{-- Add Project --}}
                                <a href="{{ route('admin.projects.create') }}" class="btn btn-purple fw-bold">
                                    Add Project
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</main>
@endsection