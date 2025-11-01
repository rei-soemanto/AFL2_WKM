@extends('layout.mainlayout')

@section('name', 'Manage Users')
@section('content')
<main class="main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="bg-overlay min-vh-100 py-5">
        <div class="container-xl py-5">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-5 fw-bold text-white">User Interests</h1>
            </div>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card card-translucent shadow-lg">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="p-3">User Name</th>
                                <th scope="col" class="p-3">Email</th>
                                <th scope="col" class="p-3">Interested Products</th>
                                <th scope="col" class="p-3">Interested Services</th>
                                <th scope="col" class="p-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="p-3 fw-bold">{{ $user->name }}</td>
                                    <td class="p-3 text-secondary">{{ $user->email }}</td>
                                    <td class="p-3">
                                        @if ($user->interested_products->count() > 0)
                                            <ul class="list-unstyled mb-0 small">
                                                @foreach ($user->interested_products as $product)
                                                    <li>{{ $product->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-secondary small">None</span>
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        @if ($user->interested_services->count() > 0)
                                            <ul class="list-unstyled mb-0 small">
                                                @foreach ($user->interested_services as $service)
                                                    <li>{{ $service->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-secondary small">None</span>
                                        @endif
                                    </td>
                                    <td class="p-3 text-center text-nowrap">
                                        <a href="mailto:{{ $user->email }}" class="btn btn-primary btn-sm fw-semibold">Contact</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-5 text-secondary">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</main>
@endsection