@extends('layout.mainlayout')

@section('name', 'Manage Projects')
@section('content')
<main class="main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="bg-overlay-dark min-vh-100 py-5">
        <div class="container-xl py-5">
            
            @if ($action === 'add' || $action === 'edit')
                
                <h1 class="display-5 fw-bold text-white mb-4">{{ $action === 'edit' ? 'Edit' : 'Add New' }} Project</h1>
                <div class="card card-translucent shadow-lg p-4">
                    <div class="card-body">
                        <form action="{{ $action === 'edit' ? url('/admin/projects/' . $project_to_edit['project_id']) : url('/admin/projects') }}" method="POST" enctype="multipart/form-data" id="projectForm">
                            @csrf
                            @if ($action === 'edit')
                                @method('PUT')
                            @endif

                            <input type="hidden" name="project_id" value="{{ $project_to_edit['project_id'] ?? '' }}">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Project Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $project_to_edit['name'] ?? '') }}" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Categories (Max 4)</label>
                                <div class="row row-cols-2 row-cols-md-4 g-3">
                                    @foreach ($categories as $category)
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="category_{{ $category['category_id'] }}" name="category_ids[]" value="{{ $category['category_id'] }}"
                                                @checked(in_array($category['category_id'], $project_categories_assigned ?? []))>
                                            <label class="form-check-label" for="category_{{ $category['category_id'] }}">{{ $category['name'] }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $project_to_edit['description'] ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label fw-bold">Add New Images</label>
                                <input type="file" id="images" name="images[]" multiple class="form-control">
                            </div>

                            @if (!empty($project_images))
                            <div class="mb-4">
                                <label class="form-label fw-bold">Current Images</label>
                                <div class="row row-cols-2 row-cols-md-4 g-3">
                                    @foreach($project_images as $image)
                                    <div class="col">
                                        <div class="position-relative">
                                            <img src="{{ asset(str_replace('../', '', $image['image_path'])) }}" alt="Current Image" class="img-fluid current-project-img rounded">
                                            <div class="form-check position-absolute top-0 end-0 bg-white-75 p-1 rounded me-1 mt-1">
                                                <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image['image_id'] }}" id="delete_img_{{ $image['image_id'] }}">
                                                <label class="form-check-label text-danger small fw-bold" for="delete_img_{{ $image['image_id'] }}">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-purple btn-lg fw-bold px-4">
                                    {{ $action === 'edit' ? 'Update' : 'Save' }} Project
                                </button>
                                <a href="{{ url('/admin/projects') }}" class="text-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            @else
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-5 fw-bold text-white">Manage Projects</h1>
                    <a href="{{ url('/admin/projects/create') }}" class="btn btn-purple btn-lg fw-bold">Add New Project</a>
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
                                    <th scope="col" class="p-3">Image</th>
                                    <th scope="col" class="p-3">Project Name</th>
                                    <th scope="col" class="p-3">Categories</th>
                                    <th scope="col" class="p-3 d-none d-md-table-cell">Last Updated</th>
                                    <th scope="col" class="p-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr>
                                        <td class="p-2">
                                            @if ($project['thumbnail'])
                                                <img src="{{ asset(str_replace('../', '', $project['thumbnail'])) }}" alt="Thumbnail" class="table-thumbnail rounded">
                                            @endif
                                        </td>
                                        <td class="p-3 fw-bold">{{ $project['name'] }}</td>
                                        <td class="p-3 text-secondary small">{{ $project['category_names'] ?? 'N/A' }}</td>
                                        <td class="p-3 text-secondary d-none d-md-table-cell">
                                            {{ \Carbon\Carbon::parse($project['updated_at'])->format('M j, Y, g:i a') }}
                                        </td>
                                        <td class="p-3 text-center text-nowrap">
                                            <a href="{{ url('/admin/projects/' . $project['project_id'] . '/edit') }}" class="btn btn-warning btn-sm fw-semibold text-dark">Edit</a>
                                            <form action="{{ url('/admin/projects/' . $project['project_id']) }}" method="POST" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Are you sure you want to delete this project?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-5 text-secondary">No projects found.</td>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('projectForm');
        if (form) {
            const checkboxes = form.querySelectorAll('input[name="category_ids[]"]');
            const max = 4;
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const checkedCount = Array.from(checkboxes).filter(i => i.checked).length;
                    if (checkedCount > max) {
                        alert('You can select a maximum of ' + max + ' categories.');
                        checkbox.checked = false;
                    }
                });
            });
        }
    });
</script>
@endpush