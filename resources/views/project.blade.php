@extends('layout.mainlayout')

@section('name', 'Project')

@section('content')
{{-- Content container with background managed via SCSS --}}
<main class="project-main-background">
    <div class="project-bg-overlay py-5">
        <div class="container-xl py-lg-5 py-3">
            
            {{-- Main Page Title --}}
            <h1 class="text-responsive-h1 text-center mb-5 text-white fw-bold">
                Our <span class="text-gold">Projects</span>
            </h1>
            
            @forelse ($project_data as $category_name => $projects_in_category)
                @php $carouselId = Str::slug($category_name); @endphp

                <div class="category-section mb-5">
                    {{-- Category Title --}}
                    <h2 class="text-responsive-h2 text-center mb-5 text-white fw-bold">
                        {{ $category_name }}
                    </h2>
                    
                    @if (count($projects_in_category) > 1)
                        <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner shadow-lg rounded-3">
                                @foreach ($projects_in_category as $index => $item)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <a href="/project/{{ $item['project_id'] }}" class="text-decoration-none">
                                            <div class="bg-custom-card-dark p-lg-5 p-4">
                                                <div class="row align-items-center g-4">
                                                    <div class="col-lg-6">
                                                        <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://placehold.co/600x400/212529/FFFFFF?text=No+Image' }}" 
                                                            alt="{{ $item['name'] }}" 
                                                            class="img-fluid rounded-3 project-card-img">
                                                    </div>
                                                    <div class="col-lg-6 text-white text-center text-lg-start">
                                                        {{-- Individual Project Title --}}
                                                        <h3 class="text-responsive-h3 fw-bold mb-3 text-gold">
                                                            {{ $item['name'] }}
                                                        </h3>
                                                        {{-- Project Description --}}
                                                        <p class="text-responsive-lead text-white-50">
                                                            {{ Str::limit($item['description'], 200) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    @else
                        @php $item = $projects_in_category[0]; @endphp
                        <a href="/project/{{ $item['project_id'] }}" class="text-decoration-none d-block shadow-lg rounded-3 overflow-hidden">
                            <div class="bg-custom-card-dark p-lg-5 p-4">
                                <div class="row align-items-center g-4">
                                    <div class="col-lg-6">
                                        <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://placehold.co/600x400/212529/FFFFFF?text=No+Image' }}" 
                                            class="img-fluid rounded-3 project-card-img" alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="col-lg-6 text-white text-center text-lg-start">
                                        <h3 class="text-responsive-h3 fw-bold mb-3 text-gold">
                                            {{ $item['name'] }}
                                        </h3>
                                        <p class="text-responsive-lead text-white-50">
                                            {{ Str::limit($item['description'], 200) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            @empty
                <div class="text-center text-white bg-custom-card-dark p-5 rounded-3 border border-secondary">
                    <p class="text-responsive-lead">No projects currently listed.</p>
                </div>
            @endforelse
        </div>
    </div>
</main>
@endsection