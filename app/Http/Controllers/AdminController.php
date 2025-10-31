<?php

namespace App\Http\Controllers;

// Illuminate Components
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Models
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
    /**
     * Display the admin dashboard with stats.
     */
    public function dashboard(): View
    {
        return view('admin.admin_dashboard', [
            'admin_username' => Auth::user()->name,
            'user_count' => User::where('role', '!=', 'admin')
                    ->where(function ($query) {
                        $query->has('interested_products')
                        ->orWhereHas('interested_services');
                    })
                    ->count(),
            'product_count' => Product::count(),
            'service_count' => Service::count(),
            'project_count' => Project::count(),
        ]);
    }

    // -----------------------------------------------------------------------
    // PRODUCT CRUD
    // -----------------------------------------------------------------------

    /**
     * Show the list of all products.
     */
    public function listProducts(): View
    {
        return view('admin.manage_product', [
            'action' => 'list',
            'products' => Product::with(['brand', 'category', 'lastUpdatedBy'])->latest('updated_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function createProduct(): View
    {
        // This assumes you fixed manage_product.blade.php as suggested
        return view('admin.manage_product', [
            'action' => 'add',
            'brands' => ProductBrand::orderBy('name')->get(),
            'categories' => ModelsProductCategory::orderBy('name')->get()
        ]);
    }

    /**
     * Store a new product in the database.
     */
    public function storeProduct(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:product_brands,id',
            'category_id' => 'required|integer|exists:product_categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf_path' => 'nullable|file|mimes:pdf|max:5120', // 5MB Max
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/products', 'public');
        }
        
        if ($request->hasFile('pdf_path')) {
            $data['pdf_path'] = $request->file('pdf_path')->store('uploads/pdfs', 'public');
        }

        $data['last_updated_by'] = Auth::id();

        Product::create($data);

        return redirect()->route('admin.products.list')->with('message', 'Product created successfully.');
    }

    /**
     * Show the form for editing a product.
     */
    public function editProduct(string $id): View
    {
        return view('admin.manage_product', [
            'action' => 'edit',
            'product_to_edit' => Product::findOrFail($id),
            'brands' => ProductBrand::orderBy('name')->get(),
            'categories' => ModelsProductCategory::orderBy('name')->get()
        ]);
    }

    /**
     * Update an existing product.
     */
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
            $data['image'] = $request->file('image')->store('uploads/products', 'public');
        }

        if ($request->hasFile('pdf_path')) {
            // Delete old PDF
            if ($product->pdf_path) {
                Storage::disk('public')->delete($product->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf_path')->store('uploads/pdfs', 'public');
        }

        $data['last_updated_by'] = Auth::id();
        $product->update($data);

        return redirect()->route('admin.products.list')->with('message', 'Product updated successfully.');
    }

    /**
     * Delete a product.
     */
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

    // -----------------------------------------------------------------------
    // SERVICE CRUD
    // -----------------------------------------------------------------------

    /**
     * Show the list of all services.
     */
    public function listServices(): View
    {
        return view('admin.manage_service', [
            'action' => 'list',
            'services' => Service::with(['category', 'lastUpdatedBy'])->latest('updated_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function createService(): View
    {
        return view('admin.manage_service', [
            'action' => 'add',
            'categories' => ServiceCategory::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a new service in the database.
     */
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

    /**
     * Show the form for editing a service.
     */
    public function editService(string $id): View
    {
        return view('admin.manage_service', [
            'action' => 'edit',
            'service_to_edit' => Service::findOrFail($id),
            'categories' => ServiceCategory::orderBy('name')->get(),
        ]);
    }

    /**
     * Update an existing service.
     */
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

    /**
     * Delete a service.
     */
    public function destroyService(string $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.list')->with('message', 'Service deleted successfully.');
    }

    // -----------------------------------------------------------------------
    // PROJECT CRUD
    // -----------------------------------------------------------------------

    /**
     * Show the list of all projects.
     */
    public function listProjects(): View
    {
        $projects = Project::with(['categories', 'images', 'lastUpdatedBy'])->latest('updated_at')->get()->map(function($project) {
        $project->category_names = $project->categories->pluck('name')->join(', ');
        $project->thumbnail = $project->images->sortBy('upload_order')->first()->image_path ?? null;
        return $project;
    });

        return view('admin.manage_project', [
            'action' => 'list',
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new project.
     */
    public function createProject(): View
    {
        return view('admin.manage_project', [
            'action' => 'add',
            'categories' => ProjectCategory::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a new project in the database.
     */
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
                $path = $file->store('uploads/projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'upload_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.list')->with('message', 'Project created successfully.');
    }

    /**
     * Show the form for editing a project.
     */
    public function editProject(string $id): View
    {
        $project = Project::with('images', 'categories')->findOrFail($id);

        return view('admin.manage_project', [
            'action' => 'edit',
            'project_to_edit' => $project,
            'project_images' => $project->images->sortBy('upload_order'),
            'project_categories_assigned' => $project->categories->pluck('id')->toArray(),
            'categories' => ProjectCategory::orderBy('name')->get(),
        ]);
    }

    /**
     * Update an existing project.
     */
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
        
        // Sync categories (removes old, adds new)
        $project->categories()->sync($data['category_ids']);

        // Delete selected images
        if ($request->has('delete_images')) {
            $images_to_delete = ProjectImage::whereIn('image_id', $request->delete_images)
                                            ->where('project_id', $project->id) // Security check
                                            ->get();
            foreach ($images_to_delete as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('uploads/projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'upload_order' => $index, // You might want a better system for ordering
                ]);
            }
        }

        return redirect()->route('admin.projects.list')->with('message', 'Project updated successfully.');
    }

    /**
     * Delete a project.
     */
    public function destroyProject(string $id): RedirectResponse
    {
        $project = Project::with('images')->findOrFail($id);

        // 1. Delete all associated images from storage and DB
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // 2. Detach all categories from pivot table
        $project->categories()->detach();

        // 3. Delete the project itself
        $project->delete();

        return redirect()->route('admin.projects.list')->with('message', 'Project deleted successfully.');
    }

    public function listUsers(): View
    {
        $users = User::with(['interested_products', 'interested_services'])
                    ->where('role', '!=', 'admin') // Don't list other admins
                    ->latest()
                    ->get();

        return view('admin.manage_user', ['users' => $users]);
    }
}