@extends('layout.mainlayout')

@section('name', 'Project')
@section('content')
<main class="project-main-background" style="background-image: url('{{ asset('img/logoWKM.jpg') }}'); background-size: 70%;">
    <div class="project-bg-overlay py-5">
        <div class="container-xl py-5">
            <h1 class="display-4 fw-bold text-center mb-5 text-white">Our <span class="text-gold">Projects</span></h1>
            
            @forelse ($project_data as $category_name => $projects_in_category)
                @php
                    $carouselId = Str::slug($category_name);
                @endphp
                <div class="mb-5">
                    <h2 class="display-5 fw-bold text-center mb-5 text-white">{{ $category_name }}</h2>
                    
                    @if (count($projects_in_category) > 1)
                        <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($projects_in_category as $index => $item)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <a href="/project/{{ $item['project_id'] }}" class="text-decoration-none">
                                            <div class="bg-dark rounded-3 shadow-lg p-5">
                                                <div class="row align-items-center g-5">
                                                    <div class="col-md-6">
                                                        <img src="{{ $item['image'] ?? 'https://placehold.co/600x400/212529/FFFFFF?text=No+Image' }}" alt="{{ $item['name'] }}" class="img-fluid rounded-3 project-card-img">
                                                    </div>
                                                    <div class="col-md-6 text-white">
                                                        <h3 class="h2 fw-bold mb-3 text-gold">{{ $item['name'] }}</h3>
                                                        <p class="text-white-50">{{ $item['description'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                    @else
                        @php $item = $projects_in_category[0]; @endphp
                        <a href="/project/{{ $item['project_id'] }}" class="text-decoration-none">
                            <div class="bg-dark rounded-3 shadow-lg p-5">
                                <div class="row align-items-center g-5">
                                    <div class="col-md-6">
                                        <img src="{{ $item['image'] ?? 'https://placehold.co/600x400/212529/FFFFFF?text=No+Image' }}" alt="{{ $item['name'] }}" class="img-fluid rounded-3 project-card-img">
                                    </div>
                                    <div class="col-md-6 text-white">
                                        <h3 class="h2 fw-bold mb-3 text-gold">{{ $item['name'] }}</h3>
                                        <p class="text-white-50">{{ $item['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            @empty
                <div class="text-center text-white bg-dark p-5 rounded-3">
                    <p class="lead">No projects are currently listed. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</main>
@endsection