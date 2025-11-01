@extends('layout.mainlayout')

@section('name', 'My Interest List')
@section('content')
<main class="main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="bg-overlay min-vh-100 py-5">
        <div class="container-xl py-5">
            
            <h1 class="display-4 fw-bold text-center mb-5 text-white">My <span class="text-gold">Interest List</span></h1>

            <div class="card card-translucent shadow-lg mb-5">
                <div class="card-header bg-dark text-white p-4">
                    <h2 class="h3 mb-0">My Interested Products</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="p-3">Product Name</th>
                                <th scope="col" class="p-3">Brand</th>
                                <th scope="col" class="p-3">Category</th>
                                <th scope="col" class="p-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="p-3 fw-bold">{{ $product->name }}</td>
                                    <td class="p-3 text-secondary">{{ $product->brand->name ?? 'N/A' }}</td>
                                    <td class="p-3 text-secondary">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="p-3 text-center text-nowrap">
                                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary btn-sm fw-semibold">View</a>
                                        
                                        <form action="{{ route('interest.product.destroy', $product->id) }}" method="POST" class="d-inline ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Are you sure you want to remove this product from your list?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-5 text-secondary">You have not added any products to your interest list.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-translucent shadow-lg">
                <div class="card-header bg-dark text-white p-4">
                    <h2 class="h3 mb-0">My Interested Services</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="p-3">Service Name</th>
                                <th scope="col" class="p-3">Category</th>
                                <th scope="col" class="p-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr>
                                    <td class="p-3 fw-bold">{{ $service->name }}</td>
                                    <td class="p-3 text-secondary">{{ $service->category->name ?? 'N/A' }}</td>
                                    <td class="p-3 text-center text-nowrap">
                                        <a href="{{ route('service.detail', $service->id) }}" class="btn btn-primary btn-sm fw-semibold">View</a>

                                        <form action="{{ route('interest.service.destroy', $service->id) }}" method="POST" class="d-inline ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Are you sure you want to remove this service from your list?');">Delete</Fbutton>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center p-5 text-secondary">You have not added any services to your interest list.</td>
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