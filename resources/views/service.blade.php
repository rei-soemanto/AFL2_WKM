@extends('layout.mainlayout')

@section('name', 'Service')
@section('content')
<main class="service-main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="service-bg-overlay py-5">
        <div class="container-xl py-5">
            <h1 class="display-4 fw-bold text-center mb-5 text-white">Our Expert <span class="text-gold">Services</span></h1>
            
            <div class="d-grid gap-5">
                @forelse ($service_data as $category_data)
                    <div class="card shadow-lg card-translucent p-4 p-md-5">
                        <div class="card-body">
                            <h2 class="display-5 fw-bold mb-2">{{ $category_data['category_name'] }}</h2>
                            <p class="lead text-secondary mb-5">{{ $category_data['category_description'] }}</p>
                            
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                @foreach ($category_data['services'] as $service)
                                <div class="col">
                                    <a href="{{ route('service.detail', ['id' => $service['id']]) }}" class="text-decoration-none">
                                        <div class="service-item h-100 custom-card-mouseover">
                                            <h3 class="h5 fw-bold" style="color: #0f0f0f;">{{ $service['name'] }}</h3>
                                            <p class="mb-0 text-secondary">{{ Str::limit($service['description'], 120) }}</p>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-white bg-dark p-5 rounded-3">
                        <p class="lead">No services are currently listed. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection