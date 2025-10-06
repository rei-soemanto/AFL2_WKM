@extends('layout.mainlayout')

@section('name', 'Service | ' . $service->name)
@section('content')
<main class="bg-dark">
    {{-- The inline style is kept for the background image, which is a common and effective practice. --}}
    <div class="font-sans" style="background-image: url('{{ asset('img/logoWKM.jpg') }}'); background-size: 70%; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
        
        {{-- Semi-transparent overlay with Bootstrap padding and flex utilities for vertical alignment --}}
        <div class="bg-black bg-opacity-75 py-5 px-4 d-flex align-items-center min-vh-100">
            
            {{-- Bootstrap's container centers the content --}}
            <div class="container">
                
                {{-- The main content card with Bootstrap styling --}}
                <div class="bg-light bg-opacity-75 rounded-3 shadow-lg p-4 p-md-5">
                    
                    {{-- Bootstrap Breadcrumb Component for clear navigation --}}
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('services') }}" class="text-decoration-none" style="color: #e0bb35;">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $service->category }}</li>
                        </ol>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4 text-dark">{{ $service->name }}</h1>
                    
                    {{-- Bootstrap Grid System. The 'g-5' class adds a large gap between columns. --}}
                    <div class="row g-5">
                        
                        {{-- Image Column: Only displays if an image exists --}}
                        @if (!empty($service->image))
                        <div class="col-lg-6">
                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded-3 shadow-lg">
                        </div>
                        @endif

                        {{-- Details Column: Takes full width if no image, or half width if an image is present --}}
                        <div class="@if(!empty($service->image)) col-lg-6 @else col-12 @endif">
                            <h2 class="fw-bold mb-4 text-dark">Service Overview</h2>
                            {{-- The 'lead' class styles the paragraph for better readability --}}
                            <p class="lead text-secondary">
                                {!! nl2br(e($service->description)) !!}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection