@extends('layout.mainlayout')

@section('name', 'Project | ' . $project->name)

@section('content')
<main class="project-detail-wrapper">
    <div class="detail-overlay py-5 px-4">
        <div class="container">

            <div class="detail-content-card shadow-lg p-4 p-md-5">
                
                {{-- Breadcrumb Navigation --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-responsive-breadcrumb">
                            <a href="{{ route('project') }}">Projects</a>
                        </li>
                        <li class="breadcrumb-item text-responsive-breadcrumb active" aria-current="page">
                            {{ $project->name }}
                        </li>
                    </ol>
                </nav>
                
                {{-- Title and Categories --}}
                <h1 class="text-responsive-h1 fw-bold mb-2">{{ $project->name }}</h1>
                <p class="text-responsive-lead text-muted fw-semibold mb-4">
                    {{ $project->category_names }}
                </p>
                
                <div class="row g-5">
                    {{-- Project Media Section --}}
                    <div class="col-lg-6">
                        @if ($project_images->isNotEmpty())
                            <div id="projectImageCarousel" class="carousel slide shadow-lg rounded overflow-hidden" data-bs-ride="carousel">
                                
                                @if ($project_images->count() > 1)
                                    <div class="carousel-indicators">
                                        @foreach ($project_images as $key => $image)
                                            <button type="button" 
                                                    data-bs-target="#projectImageCarousel" 
                                                    data-bs-slide-to="{{ $key }}" 
                                                    class="{{ $loop->first ? 'active' : '' }}" 
                                                    aria-current="{{ $loop->first ? 'true' : 'false' }}">
                                            </button>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="carousel-inner">
                                    @foreach ($project_images as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                class="d-block w-100 project-detail-img" 
                                                alt="{{ $project->name }}">
                                        </div>
                                    @endforeach
                                </div>

                                @if ($project_images->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#projectImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#projectImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                @endif
                            </div>
                        @else
                            <img src="https://placehold.co/600x400/CCCCCC/FFFFFF?text=No+Image" 
                                alt="No Image Available" 
                                class="img-fluid rounded-3 shadow-lg w-100">
                        @endif
                    </div>

                    {{-- Project Description Section --}}
                    <div class="col-lg-6">
                        <h2 class="text-responsive-h2 fw-bold mb-4">Project Overview</h2>
                        <div class="text-responsive-lead fw-normal mb-4">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection