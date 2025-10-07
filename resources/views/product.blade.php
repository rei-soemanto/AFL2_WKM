@extends('layout.mainlayout')

@section('name', 'Product')
@section('content')
<main class="product-main-background" style="background-image: url('{{ asset('img/logoWKM.jpg') }}'); background-size: 70%;">
    <div class="product-bg-overlay py-5">
        <div class="container-xl py-5">
            <h1 class="display-4 fw-bold text-center mb-5 text-white">Our Innovative <span class="text-gold">Products & Solutions</span></h1>
            
            @forelse ($product_data as $brand_name => $products_in_brand)
            <div class="mb-5">
                <h2 class="display-5 fw-bold text-center mb-5 text-white">{{ $brand_name }}</h2>
                
                <div class="row row-cols-1 row-cols-lg-2 g-4">
                    @foreach ($products_in_brand as $item)
                    <div class="col">
                        <a href="{{ route('product.detail', ['id' => $item->id]) }}" class="text-decoration-none h-100 d-block">
                            <div class="card bg-custom-card-dark text-white h-100 shadow-lg custom-card-hover">
                                <div class="row g-0 h-100">
                                    <div class="col-md-7">
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text text-white-50 mb-2">{{ $item->category->name ?? 'Uncategorized' }}</p>
                                            <h3 class="card-title h4 fw-bold mb-2 text-gold">{{ $item->name }}</h3>
                                            <p class="card-text small">{{ $item->description }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 d-flex align-items-center p-3">
                                        <img src="{{ asset($item->image) ?? 'https://placehold.co/600x400/212529/FFFFFF?text=No+Image' }}" class="img-fluid rounded product-card-img" alt="{{ $item->name }}">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
                <div class="text-center text-white bg-dark p-5 rounded-3">
                    <p class="lead">No products are currently listed. Please check back later.</p>
                </div>
            @endforelse

        </div>
    </div>
</main>
@endsection