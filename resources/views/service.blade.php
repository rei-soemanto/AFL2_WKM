@extends('layout.mainlayout')

@section('name', 'Service')

@section('content')
<main class="service-main-background">
    <div class="service-bg-overlay py-5">
        <div class="container-xl py-lg-5 py-3">
            
            {{-- Main Section Title --}}
            <h1 class="text-responsive-h1 fw-bold text-center mb-5 text-white">
                Our Expert <span class="text-gold">Services</span>
            </h1>
            
            <div class="d-grid gap-5">
                @forelse ($service_data as $category_data)
                    <div class="card shadow-lg card-translucent p-4 p-md-5 border-0">
                        <div class="card-body">
                            {{-- Category Title and Description --}}
                            <h2 class="text-responsive-h2 fw-bold mb-2 text-dark">
                                {{ $category_data['category_name'] }}
                            </h2>
                            <p class="text-responsive-lead text-secondary mb-5">
                                {{ $category_data['category_description'] }}
                            </p>
                            
                            {{-- Service Items Grid --}}
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                @foreach ($category_data['services'] as $service)
                                    <div class="col">
                                        <a href="{{ route('service.detail', ['id' => $service['id']]) }}" class="text-decoration-none h-100 d-block">
                                            <div class="service-item h-100 custom-card-mouseover">
                                                <h3 class="text-responsive-h3 fw-bold text-dark">
                                                    {{ $service['name'] }}
                                                </h3>
                                                <p class="mb-0 text-secondary">
                                                    {{ Str::limit($service['description'], 120) }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div class="text-center text-white bg-custom-card-dark p-5 rounded-3 border border-secondary">
                        <p class="text-responsive-lead">No services are currently listed. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection