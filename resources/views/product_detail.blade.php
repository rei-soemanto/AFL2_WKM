@extends('layout.mainlayout')

@section('name', 'Product | ' . $product->name)
@section('content')
<main class="font-sans" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
    <div class="bg-black bg-opacity-75 py-5 px-4 min-vh-100 d-flex align-items-center">
        
        <div class="container">

            <div class="bg-light bg-opacity-75 rounded-3 shadow-lg p-4 p-md-5">
                
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('product') }}" class="text-decoration-none" style="color: #e0bb35;">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
                
                <h1 class="display-4 fw-bold mb-2 text-dark">{{ $product->name }}</h1>
                
                <p class="fs-5 text-muted fw-semibold mb-4">
                    {{ $product->brand->name ?? 'No Brand' }}
                    @if ($product->category)
                        - {{ $product->category->name }}
                    @endif
                </p>
                
                <div class="row g-5">
                    <div class="col-lg-6">
                        <img src="{{ asset($product->image ?? 'https://placehold.co/600x400/CCCCCC/FFFFFF?text=No+Image') }}" alt="{{ $product->name }}" class="img-fluid rounded-3 shadow-lg">
                    </div>

                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4 text-dark">Product Overview</h2>
                        <div class="lead text-secondary mb-4">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                        @if ($product->pdf_path)
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