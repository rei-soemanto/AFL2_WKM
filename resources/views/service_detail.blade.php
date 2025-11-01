@extends('layout.mainlayout')

@section('name', 'Service | ' . $service->name)
@section('content')
<main class="bg-black">
    <div class="font-sans" style="background-image: url('{{ asset('img/logoWKM.jpg') }}'); background-size: 70%; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
        
        <div class="bg-black bg-opacity-75 py-5 px-4 d-flex align-items-center min-vh-100">
            
            <div class="container">
                
                <div class="bg-light bg-opacity-95 rounded-3 shadow-lg p-4 p-md-5">

                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('service') }}" class="text-decoration-none" style="color: #000000;">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
                        </ol>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4 text-dark">{{ $service->name }}</h1>
                    
                    <div class="row g-5">
                        
                        @if (!empty($service->image))
                        <div class="col-lg-6">
                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded-3 shadow-lg">
                        </div>
                        @endif

                        <div class="@if(!empty($service->image)) col-lg-6 @else col-12 @endif">
                            <h2 class="fw-bold mb-4 text-dark">Service Overview</h2>
                            <p class="lead fw-normal">
                                {!! nl2br(e($service->description)) !!}
                            </p>

                            @auth
                                @if(Auth::user()->role != 'admin')
                                
                                    @if ($isInterested)
                                        <button class="btn btn-success btn-lg fw-bold" disabled>
                                            <i class="bi bi-check-lg"></i> Added to List
                                        </button>
                                    @else
                                        <form action="{{ route('interest.service.store', $service->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-lg fw-bold" title="Add to Interest List">
                                                <i class="bi bi-plus-circle"></i> Add to Interest
                                            </button>
                                        </form>
                                    @endif

                                @endif
                            @endauth
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection