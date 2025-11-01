@extends('layout.mainlayout')

@section('name', 'Manage Services')
@section('content')
<main class="main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="bg-overlay min-vh-100 py-5">
        <div class="container-xl py-5">
            
            @if ($action === 'add' || $action === 'edit')
                
                <h1 class="display-5 fw-bold text-white mb-4">{{ $action === 'edit' ? 'Edit' : 'Add New' }} Service</h1>
                <div class="card card-translucent shadow-lg p-4">
                    <div class="card-body">
                        <form action="{{ $action === 'edit' ? route('admin.services.update', $service_to_edit->id) : route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($action === 'edit')
                                @method('PUT')
                            @endif

                            <input type="hidden" name="service_id" value="{{ $service_to_edit['service_id'] ?? '' }}">

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Service Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $service_to_edit->name ?? '') }}" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-bold">Category</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            @selected(old('category_id', $service_to_edit->category_id ?? '') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $service_to_edit['description'] ?? '') }}</textarea>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-success btn-lg fw-bold px-4">
                                    {{ $action === 'edit' ? 'Update' : 'Save' }} Service
                                </button>
                                <a href="{{ route('admin.services.list') }}" class="text-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            @else
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-5 fw-bold text-white">Manage Services</h1>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-success btn-lg fw-bold">Add New Service</a>
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
                                    <th scope="col" class="p-3">Service Name</th>
                                    <th scope="col" class="p-3">Category</th>
                                    <th scope="col" class="p-3 d-none d-md-table-cell">Last Updated</th>
                                    <th scope="col" class="p-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $service)
                                    <tr>
                                        <td class="p-3 fw-bold">{{ $service->name }}</td>
                                        <td class="p-3 text-secondary">{{ $service->category->name ?? 'N/A' }}</td>
                                        <td class="p-3 text-secondary d-none d-md-table-cell">
                                            {{ $service->lastUpdatedBy->name ?? 'N/A' }} | {{ $service->updated_at->format('M j, Y, g:i a') }}
                                        </td>
                                        <td class="p-3 text-center text-nowrap">
                                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm fw-semibold text-dark">Edit</a>
                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Are you sure you want to delete this service?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-5 text-secondary">No services found.</td>
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