@extends('layout.mainlayout')

@section('name', 'Forbidden')
@section('content')
<main class="bg-black">
    <div class="hero-container d-flex flex-column">
        <div class="bg-overlay-darker flex-grow-1 d-flex align-items-center justify-content-center text-center">
            
            <div>
                <h1 class="display-huge fw-bolder text-gold">403</h1>
                <p class="h2 fw-bold text-white mt-4">Forbidden</p>
                
                <p class="text-white-50 mt-4">Sorry, the page you are looking for is forbidden.</p>
                
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