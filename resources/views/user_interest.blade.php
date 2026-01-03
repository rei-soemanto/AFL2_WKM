@extends('layout.mainlayout')

@section('name', 'My Interest List')

@section('content')
<main class="interest-main-background">
    <div class="interest-bg-overlay min-vh-100 py-5">
        <div class="container-xl py-lg-5 py-3">
            
            <h1 class="text-responsive-h1 fw-bold text-center mb-5 text-white">
                My <span class="text-gold">Interest List</span>
            </h1>

            {{-- Products Table --}}
            <div class="card card-translucent shadow-lg mb-5 border-0 overflow-hidden">
                <div class="card-header bg-custom-dark text-white p-4">
                    <h2 class="text-responsive-h3 mb-0 text-center">My Interested Products</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-custom-dark text-white">
                            <tr>
                                <th scope="col" class="p-3 border-0">Product Name</th>
                                <th scope="col" class="p-3 d-none d-md-table-cell border-0">Brand</th>
                                <th scope="col" class="p-3 d-none d-lg-table-cell border-0">Category</th>
                                <th scope="col" class="p-3 text-center border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="p-3 fw-bold text-dark">{{ $product->name }}</td>
                                    <td class="p-3 text-secondary d-none d-md-table-cell">{{ $product->brand->name ?? 'N/A' }}</td>
                                    <td class="p-3 text-secondary d-none d-lg-table-cell">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="p-3">
                                        <div class="interest-action-group">
                                            <a href="{{ route('product.detail', $product->id) }}" 
                                                class="btn btn-primary text-responsive-btn-sm fw-semibold">View</a>
                                            
                                            <form action="{{ route('interest.product.destroy', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger text-responsive-btn-sm fw-semibold" 
                                                        onclick="return confirm('Remove this product?');">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-5 text-secondary text-responsive-lead">
                                        You have not added any products yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Services Table --}}
            <div class="card card-translucent shadow-lg border-0 overflow-hidden">
                <div class="card-header bg-custom-dark text-white p-4">
                    <h2 class="text-responsive-h3 mb-0 text-center">My Interested Services</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-custom-dark text-white">
                            <tr>
                                <th scope="col" class="p-3 border-0">Service Name</th>
                                <th scope="col" class="p-3 d-none d-md-table-cell border-0">Category</th>
                                <th scope="col" class="p-3 text-center border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr>
                                    <td class="p-3 fw-bold text-dark">{{ $service->name }}</td>
                                    <td class="p-3 text-secondary d-none d-md-table-cell">{{ $service->category->name ?? 'N/A' }}</td>
                                    <td class="p-3">
                                        <div class="interest-action-group">
                                            <a href="{{ route('service.detail', $service->id) }}" 
                                                class="btn btn-primary text-responsive-btn-sm fw-semibold">View</a>

                                            <form action="{{ route('interest.service.destroy', $service->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger text-responsive-btn-sm fw-semibold" 
                                                        onclick="return confirm('Remove this service?');">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center p-5 text-secondary text-responsive-lead">
                                        You have not added any services yet.
                                    </td>
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