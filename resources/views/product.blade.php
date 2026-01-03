@extends('layout.mainlayout')

@section('name', 'Product')

@section('content')
<main class="product-main-background">
    <div class="product-bg-overlay py-5">
        <div class="container-xl py-lg-5 py-3">
            
            <h1 class="text-responsive-h1 text-center mb-5 text-white fw-bold">
                Our Innovative <span class="text-gold">Products & Solutions</span>
            </h1>
            
            @forelse ($product_data as $brand_name => $products_in_brand)
                @php $brandSlug = Str::slug($brand_name); @endphp

                <div class="brand-section mb-5">
                    <h2 class="text-responsive-h2 text-center mb-5 text-white fw-bold">
                        {{ $brand_name }}
                    </h2>
                    
                    <div class="row row-cols-1 row-cols-lg-2 g-4">
                        @foreach ($products_in_brand as $item)
                            {{-- Initial visibility logic for 'Show More' functionality --}}
                            <div class="col product-item {{ $loop->iteration > 10 ? 'd-none' : '' }}" data-brand="{{ $brandSlug }}">
                                <a href="{{ route('product.detail', ['id' => $item->id]) }}" class="text-decoration-none h-100 d-block">
                                    <div class="card bg-custom-card-dark text-white h-100 shadow-lg border-0">
                                        <div class="row g-0 h-100">
                                            <div class="col-md-7">
                                                <div class="card-body d-flex flex-column h-100">
                                                    {{-- Category tag --}}
                                                    <p class="text-responsive-lead text-white-50 mb-2">
                                                        {{ $item->category->name ?? 'Uncategorized' }}
                                                    </p>
                                                    {{-- Product Title --}}
                                                    <h3 class="text-responsive-h3 fw-bold mb-2 text-gold">
                                                        {{ $item->name }}
                                                    </h3>
                                                    {{-- Product Excerpt --}}
                                                    <p class="text-responsive-lead small mb-0">
                                                        {{ Str::limit($item->description, 120) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-5 d-flex align-items-center p-3">
                                                <img src="{{ asset('storage/' . $item->image) ?? 'https://placehold.co/600x400/212529/FFFFFF?text=No+Image' }}" 
                                                     class="img-fluid rounded-3 product-card-img" 
                                                     alt="{{ $item->name }}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Show More Trigger --}}
                    @if ($products_in_brand->count() > 10)
                        <div class="text-center mt-4">
                            <button class="btn-res text-responsive-btn btn-custom fw-bold text-nowrap show-more-btn" data-brand="{{ $brandSlug }}">
                                Show More
                            </button>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center text-white bg-custom-card-dark p-5 rounded-3 border border-secondary">
                    <p class="text-responsive-lead">No products are currently listed. Please check back later.</p>
                </div>
            @endforelse

        </div>
    </div>
</main>
@endsection