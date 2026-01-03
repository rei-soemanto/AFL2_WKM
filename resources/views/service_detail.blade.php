@extends('layout.mainlayout')

@section('name', 'Service | ' . $service->name)

@section('content')
<main class="service-detail-wrapper">
    <div class="detail-overlay py-5 px-4">
        <div class="container">
            <div class="detail-content-card shadow-lg p-4 p-md-5">

                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                
                {{-- Breadcrumb Navigation --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text-responsive-breadcrumb">
                            <a href="{{ route('service') }}">Services</a>
                        </li>
                        <li class="breadcrumb-item text-responsive-breadcrumb active" aria-current="page">
                            {{ $service->name }}
                        </li>
                    </ol>
                </nav>
                
                {{-- Service Title --}}
                <h1 class="text-responsive-h1 fw-bold mb-4">{{ $service->name }}</h1>
                
                <div class="row g-5">
                    {{-- Media Column (Conditional) --}}
                    @if (!empty($service->image))
                        <div class="col-lg-6">
                            <img src="{{ asset($service->image) }}" 
                                 alt="{{ $service->name }}" 
                                 class="img-fluid rounded-3 shadow-lg w-100">
                        </div>
                    @endif

                    {{-- Description Column --}}
                    <div class="@if(!empty($service->image)) col-lg-6 @else col-12 @endif">
                        <h2 class="text-responsive-h2 fw-bold mb-4">Service Overview</h2>
                        <div class="text-responsive-lead fw-normal mb-5">
                            {!! nl2br(e($service->description)) !!}
                        </div>

                        {{-- Action Buttons --}}
                        @auth
                            @if(Auth::user()->role != 'admin')
                                <div class="detail-button-group">
                                    @if ($isInterested)
                                        <button class="btn btn-success text-responsive-btn fw-bold" disabled>
                                            <i class="bi bi-check-lg"></i> Added to List
                                        </button>
                                    @else
                                        <form action="{{ route('interest.service.store', $service->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary text-responsive-btn fw-bold" title="Add to Interest List">
                                                <i class="bi bi-plus-circle"></i> Add to Interest
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection