@extends('layout.mainlayout')

@section('name', 'Server Error')
@section('content')
<main class="bg-black">
    <div class="hero-container d-flex flex-column">
        <div class="bg-overlay-darker flex-grow-1 d-flex align-items-center justify-content-center text-center">
            
            <div>
                <h1 class="display-huge fw-bolder text-gold">500</h1>
                <p class="h2 fw-bold text-white mt-4">Server Error</p>
                
                <p class="text-white-50 mt-4">Sorry, we are experiencing technical difficulties. Please try again later.</p>
                
                <div class="mt-5">
                    <a href="{{ url('/') }}" class="btn btn-gold btn-lg fw-bold">
                        Go Back Home
                    </a>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection