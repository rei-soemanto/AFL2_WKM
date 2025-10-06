@extends('layout.mainlayout')

@section('name', 'Project | ' . $project->name)
@section('content')
{{-- The inline style for the background is kept as it's the most direct way to apply the image URL. --}}
<main class="font-sans" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
    
    {{-- A semi-transparent overlay with vertical centering and padding --}}
    <div class="bg-black bg-opacity-75 py-5 px-4 min-vh-100 d-flex align-items-center">
        
        {{-- Bootstrap's container centers the content on the page --}}
        <div class="container">

            <div class="bg-light bg-opacity-75 rounded-3 shadow-lg p-4 p-md-5">
                
                {{-- Bootstrap Breadcrumb Component for navigation --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('projects') }}" class="text-decoration-none" style="color: #e0bb35;">Projects</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
                    </ol>
                </nav>
                
                <h1 class="display-4 fw-bold mb-2 text-dark">{{ $project->name }}</h1>
                <p class="fs-5 text-muted fw-semibold mb-4">{{ $project->category_names }}</p>
                
                {{-- Bootstrap Grid System for the two-column layout. g-5 creates a large gap. --}}
                <div class="row g-5">
                    
                    {{-- Left Column: Image Carousel --}}
                    <div class="col-lg-6">
                        @if ($project_images->isNotEmpty())
                            {{-- Bootstrap Carousel Component --}}
                            <div id="projectImageCarousel" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                                
                                {{-- Carousel Indicators (the dots at the bottom) --}}
                                @if ($project_images->count() > 1)
                                    <div class="carousel-indicators">
                                        @foreach ($project_images as $key => $image)
                                            <button type="button" data-bs-target="#projectImageCarousel" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Carousel Inner Content (the images) --}}
                                <div class="carousel-inner rounded">
                                    @foreach ($project_images as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset($image->image_path) }}" class="d-block w-100" style="aspect-ratio: 4/3; object-fit: cover;" alt="{{ $project->name }}">
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Carousel Controls (the arrows) --}}
                                @if ($project_images->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#projectImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#projectImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @else
                            {{-- Placeholder if no images are available --}}
                            <img src="https://placehold.co/600x400/CCCCCC/FFFFFF?text=No+Image" alt="No Image Available" class="img-fluid rounded-3 shadow-lg">
                        @endif
                    </div>

                    {{-- Right Column: Project Details --}}
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4 text-dark">Project Overview</h2>
                        {{-- The "lead" class provides nice styling for descriptive text --}}
                        <div class="lead text-secondary">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection