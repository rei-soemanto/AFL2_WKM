<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory as ModelsProductCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\User;

class AdminController extends Controller
{
    // Display admin dashboard with stats
    public function dashboard(): View
    {
        return view('admin.admin_dashboard', [
            'admin_username' => Auth::user()->name,
            'user_count' => User::where('role', '!=', 'admin')->where(function ($query) {
                $query->has('interested_products')
                ->orWhereHas('interested_services');
            })->count(),
            'product_count' => Product::count(),
            'service_count' => Service::count(),
            'project_count' => Project::count(),
        ]);
    }

    // PRODUCT CRUD
    // Show list of all products
    public function listProducts(): View
    {
        return view('admin.manage_product', [
            'action' => 'list',
            'products' => Product::with(['brand', 'category', 'lastUpdatedBy'])->orderBy('id', 'asc')->get(),
        ]);
    }

    // Show form for creating new product
    public function createProduct(): View
    {
        return view('admin.manage_product', [
            'action' => 'add',
            'brands' => ProductBrand::orderBy('id', 'asc')->get(),
            'categories' => ModelsProductCategory::orderBy('id', 'asc')->get()
        ]);
    }

    // Store new product in database
    public function storeProduct(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:product_brands,id',
            'category_id' => 'required|integer|exists:product_categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf_path' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/image/products', 'public');
        }
        
        if ($request->hasFile('pdf_path')) {
            $data['pdf_path'] = $request->file('pdf_path')->store('uploads/pdf', 'public');
        }

        $data['last_updated_by'] = Auth::id();

        Product::create($data);

        return redirect()->route('admin.products.list')->with('message', 'Product created successfully.');
    }

    // Show form for editing product
    public function editProduct(string $id): View
    {
        return view('admin.manage_product', [
            'action' => 'edit',
            'product_to_edit' => Product::findOrFail($id),
            'brands' => ProductBrand::orderBy('id', 'asc')->get(),
            'categories' => ModelsProductCategory::orderBy('id', 'asc')->get()
        ]);
    }

    // Update existing product
    public function updateProduct(Request $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:product_brands,id',
            'category_id' => 'required|integer|exists:product_categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf_path' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('uploads/image/products', 'public');
        }

        if ($request->hasFile('pdf_path')) {
            // Delete old PDF
            if ($product->pdf_path) {
                Storage::disk('public')->delete($product->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf_path')->store('uploads/pdf', 'public');
        }

        $data['last_updated_by'] = Auth::id();
        $product->update($data);

        return redirect()->route('admin.products.list')->with('message', 'Product updated successfully.');
    }

    // Delete product
    public function destroyProduct(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        // Delete associated files
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->pdf_path) {
            Storage::disk('public')->delete($product->pdf_path);
        }

        $product->delete();

        return redirect()->route('admin.products.list')->with('message', 'Product deleted successfully.');
    }

    // SERVICE CRUD
    // Show list of all services.
    public function listServices(): View
    {
        return view('admin.manage_service', [
            'action' => 'list',
            'services' => Service::with(['category', 'lastUpdatedBy'])->orderBy('id', 'asc')->get(),
        ]);
    }

    // Show form for creating new service.
    public function createService(): View
    {
        return view('admin.manage_service', [
            'action' => 'add',
            'categories' => ServiceCategory::orderBy('id', 'asc')->get(),
        ]);
    }

    // Store new service in database
    public function storeService(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:service_categories,id',
            'description' => 'nullable|string',
        ]);
        
        $data['last_updated_by'] = Auth::id();
        Service::create($data);

        return redirect()->route('admin.services.list')->with('message', 'Service created successfully.');
    }

    // Show form for editing service
    public function editService(string $id): View
    {
        return view('admin.manage_service', [
            'action' => 'edit',
            'service_to_edit' => Service::findOrFail($id),
            'categories' => ServiceCategory::orderBy('id', 'asc')->get(),
        ]);
    }

    // Update existing service
    public function updateService(Request $request, string $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:service_categories,id',
            'description' => 'nullable|string',
        ]);

        $data['last_updated_by'] = Auth::id();
        $service->update($data);

        return redirect()->route('admin.services.list')->with('message', 'Service updated successfully.');
    }

    // Delete service
    public function destroyService(string $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.list')->with('message', 'Service deleted successfully.');
    }

    // PROJECT CRUD
    // Show list of all projects
    public function listProjects(): View
    {
        $projects = Project::with(['categories', 'images', 'lastUpdatedBy'])->orderBy('id', 'asc')->get()->map(function($project) {
        $project->category_names = $project->categories->pluck('name')->join(', ');
        $project->thumbnail = $project->images->sortBy('upload_order')->first()->image_path ?? null;
        return $project;
    });

        return view('admin.manage_project', [
            'action' => 'list',
            'projects' => $projects,
        ]);
    }

    // Show form for creating new project
    public function createProject(): View
    {
        return view('admin.manage_project', [
            'action' => 'add',
            'categories' => ProjectCategory::orderBy('id', 'asc')->get(),
        ]);
    }

    // Store new project in database
    public function storeProject(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_ids' => 'required|array|max:4',
            'category_ids.*' => 'integer|exists:project_categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data['last_updated_by'] = Auth::id();
        
        $project = Project::create($data);
        $project->categories()->attach($data['category_ids']);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('uploads/image/projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'upload_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.list')->with('message', 'Project created successfully.');
    }

    // Show form for editing project
    public function editProject(string $id): View
    {
        $project = Project::with('images', 'categories')->findOrFail($id);

        return view('admin.manage_project', [
            'action' => 'edit',
            'project_to_edit' => $project,
            'project_images' => $project->images->sortBy('upload_order'),
            'project_categories_assigned' => $project->categories->pluck('id')->toArray(),
            'categories' => ProjectCategory::orderBy('id', 'asc')->get(),
        ]);
    }

    // Update existing project
    public function updateProject(Request $request, string $id): RedirectResponse
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_ids' => 'required|array|max:4',
            'category_ids.*' => 'integer|exists:project_categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:project_images,id',
        ]);
        
        $data['last_updated_by'] = Auth::id();
        $project->update($data);
        
        // Sync categories
        $project->categories()->sync($data['category_ids']);

        // Delete selected image
        if ($request->has('delete_images')) {
            $images_to_delete = ProjectImage::whereIn('image_id', $request->delete_images)->where('project_id', $project->id)->get();
            foreach ($images_to_delete as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        }

        // Add new image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('uploads/image/projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'upload_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.list')->with('message', 'Project updated successfully.');
    }

    // Delete project
    public function destroyProject(string $id): RedirectResponse
    {
        $project = Project::with('images')->findOrFail($id);

        // Delete all associated image from storage and DB
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // Detach all categories from pivot table
        $project->categories()->detach();

        // Delete the project
        $project->delete();

        return redirect()->route('admin.projects.list')->with('message', 'Project deleted successfully.');
    }

    // USER
    // Show list of all user has interest
    public function listUsers(): View
    {
        $users = User::where('role', '!=', 'admin')->where(function ($query) {
            $query->has('interested_products')->orWhereHas('interested_services');
        })->with(['interested_products', 'interested_services'])->latest()->get();

        return view('admin.manage_user', ['users' => $users]);
    }
}