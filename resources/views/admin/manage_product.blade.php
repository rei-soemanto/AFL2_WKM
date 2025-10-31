@extends('layout.mainlayout')

@section('name', 'Manage Products')
@section('content')
<main class="main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="bg-overlay-dark min-vh-100 py-5">
        <div class="container-xl py-5">
            
            @if ($action === 'add' || $action === 'edit')
                
                <h1 class="display-5 fw-bold text-white mb-4">{{ $action === 'edit' ? 'Edit' : 'Add New' }} Product</h1>
                <div class="card card-translucent shadow-lg p-4">
                    <div class="card-body">
                        <form action="{{ $action === 'edit' ? url('/admin/products/' . $product_to_edit['product_id']) : url('/admin/products') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($action === 'edit')
                                @method('PUT')
                            @endif

                            <input type="hidden" name="product_id" value="{{ $product_to_edit['product_id'] ?? '' }}">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Product Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $product_to_edit['name'] ?? '') }}" class="form-control" required>
                            </div>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="brand_id" class="form-label fw-bold">Brand</label>
                                    <select id="brand_id" name="brand_id" class="form-select" required>
                                        <option value="">Select a brand</option>
                                        @foreach ($brands as $brand) <option value="{{ $brand->id }}" 
                                                @selected(old('brand_id', $product_to_edit['brand_id'] ?? '') == $brand->brand_id)>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label fw-bold">Category</label>
                                    <select id="category_id" name="category_id" class="form-select" required>
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category) <option value="{{ $category->id }}" 
                                                @selected(old('category_id', $product_to_edit['category_id'] ?? '') == $category->category_id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $product_to_edit['description'] ?? '') }}</textarea>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label for="image" class="form-label fw-bold">Product Image</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    @if (!empty($product_to_edit['image']))
                                        <small class="text-muted mt-2 d-block">Current image: {{ basename($product_to_edit['image']) }}</small>
                                        <input type="hidden" name="existing_image" value="{{ $product_to_edit['image'] }}">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="product_pdf" class="form-label fw-bold">Product PDF</label>
                                    <input type="file" id="product_pdf" name="pdf_path" class="form-control">
                                    @if (!empty($product_to_edit['pdf_path']))
                                        <small class="text-muted mt-2 d-block">Current PDF: {{ basename($product_to_edit['pdf_path']) }}</small>
                                        <input type="hidden" name="existing_pdf" value="{{ $product_to_edit['pdf_path'] }}">
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold px-4">
                                    {{ $action === 'edit' ? 'Update' : 'Save' }} Product
                                </button>
                                <a href="{{ url('/admin/products') }}" class="text-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            @else
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-5 fw-bold text-white">Manage Products</h1>
                    <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-lg fw-bold">Add New Product</a>
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
                                    <th scope="col" class="p-3">Product Name</th>
                                    <th scope="col" class="p-3">Primary Category</th>
                                    <th scope="col" class="p-3">Second Category</th>
                                    <th scope="col" class="p-3 d-none d-md-table-cell">Last Updated</th>
                                    <th scope="col" class="p-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="p-3 fw-bold">{{ $product['name'] }}</td>
                                        <td class="p-3 text-secondary">{{ $product['category_name'] ?? 'N/A' }}</td>
                                        <td class="p-3 text-secondary">{{ $product['second_category_name'] ?? 'N/A' }}</td>
                                        <td class="p-3 text-secondary d-none d-md-table-cell">
                                            {{ \Carbon\Carbon::parse($product['updated_at'])->format('M j, Y, g:i a') }}
                                        </td>
                                        <td class="p-3 text-center text-nowrap">
                                            <a href="{{ url('/admin/products/' . $product['product_id'] . '/edit') }}" class="btn btn-warning btn-sm fw-semibold text-dark">Edit</a>
                                            <form action="{{ url('/admin/products/' . $product['product_id']) }}" method="POST" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-5 text-secondary">No products found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection