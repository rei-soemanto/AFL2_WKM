@extends('layout.mainlayout')

@section('name', 'Product | ' . $product->name)
@section('content')
{{-- The inline style for the background image is kept as it's the most direct way to apply a dynamic asset URL. --}}
<main class="font-sans" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
    {{-- The dark overlay with padding --}}
    <div class="bg-black bg-opacity-75 py-5 px-4 min-vh-100 d-flex align-items-center">
        
        {{-- Bootstrap's container centers the content --}}
        <div class="container">

            {{-- The main content card --}}
            <div class="bg-light bg-opacity-75 rounded-3 shadow-lg p-4 p-md-5">
                
                {{-- Bootstrap Breadcrumb Component --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-decoration-none" style="color: #e0bb35;">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
                
                {{-- Display headings for a larger title --}}
                <h1 class="display-4 fw-bold mb-2 text-dark">{{ $product->name }}</h1>
                
                <p class="fs-5 text-muted fw-semibold mb-4">
                    {{ $product->brand->name ?? 'No Brand' }}
                    @if ($product->category)
                        - {{ $product->category->name }}
                    @endif
                </p>
                
                {{-- Bootstrap Grid System for the two-column layout --}}
                <div class="row g-5">
                    {{-- Left Column: Image --}}
                    <div class="col-lg-6">
                        <img src="{{ asset($product->image ?? 'https://placehold.co/600x400/CCCCCC/FFFFFF?text=No+Image') }}" alt="{{ $product->name }}" class="img-fluid rounded-3 shadow-lg">
                    </div>

                    {{-- Right Column: Product Details --}}
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4 text-dark">Product Overview</h2>
                        {{-- The "lead" class makes the description stand out --}}
                        <div class="lead text-secondary mb-4">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                        @if ($product->pdf_path)
                            {{-- Bootstrap Button Component --}}
                            <a href="{{ asset($product->pdf_path) }}" download class="btn btn-dark btn-lg fw-bold">
                                Download PDF
                            </a>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>
@endsection