<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PageController extends Controller
{
    // Display list of all products grouped by brand
    public function products(): View
    {
        $products = Product::with(['brand', 'category'])->get();

        $product_data = $products->groupBy('brand.name');

        return view('product', ['product_data' => $product_data]);
    }

    // Display details of single product
    public function productDetail(string $id): View
    {
        $product = Product::with(['brand', 'category'])->findOrFail($id);

        $isInterested = false;
        if (Auth::check() && Auth::user()->role != 'admin') {
            $isInterested = Auth::user()->interested_products()->where('product_id', $product->id)->exists();
        }

        return view('product_detail', [
            'product' => $product,
            'isInterested' => $isInterested,
        ]);
    }

    // Display list of all projects grouped by category
    public function projects(): View
    {
        $project_data = [];
        $categories = ProjectCategory::whereHas('projects')->with(['projects.images'])->get();

        foreach ($categories as $category) {
            $projects_in_category = [];
            foreach ($category->projects as $project) {
                $first_image = $project->images->sortBy('upload_order')->first();

                $projects_in_category[] = [
                    'project_id' => $project->id,
                    'name' => $project->name,
                    'description' => $project->description,
                    'image' => $first_image ? $first_image->image_path : null,
                ];
            }
            $project_data[$category->name] = $projects_in_category;
        }

        return view('project', ['project_data' => $project_data]);
    }

    // Display details of single project
    public function projectDetail(string $id): View
    {
        $project = Project::with(['categories', 'images'])->findOrFail($id);

        $project->category_names = $project->categories->pluck('name')->join(', ');

        $project_images = $project->images->sortBy('upload_order');

        return view('project_detail', [
            'project' => $project,
            'project_images' => $project_images
        ]);
    }

    // Display list of all services grouped by category
    public function services(): View
    {
        $service_categories = ServiceCategory::with('services')->get();
        
        $service_data = $service_categories->map(function ($category) {
            return [
                'category_name' => $category->name,
                'category_description' => 'Services related to ' . $category->name,
                'services' => $category->services->map(function ($service) {
                    return [
                        'id' => $service->id,
                        'name' => $service->name,
                        'description' => $service->description,
                    ];
                })->all(),
            ];
        })->all();

        return view('service', ['service_data' => $service_data]);
    }

    // Display details of single service
    public function serviceDetail(string $id): View
    {
        $service = Service::with('category')->findOrFail($id);

        $isInterested = false;
        if (Auth::check() && Auth::user()->role != 'admin') {
            $isInterested = Auth::user()->interested_services()->where('service_id', $service->id)->exists();
        }

        return view('service_detail', [
            'service' => $service,
            'isInterested' => $isInterested,
        ]);
    }

    // Display authenticated non-admin user interest
    public function myInterests(): View
    {
        $user = Auth::user();

        $products = $user->interested_products()->with(['brand', 'category'])->get();

        $services = $user->interested_services()->with('category')->get();

        return view('user_interest', [
            'products' => $products,
            'services' => $services,
        ]);
    }

    // Add product to user interest
    public function addInterestedProduct(string $id): RedirectResponse
    {
        $user = Auth::user();
        
        $user->interested_products()->syncWithoutDetaching($id);

        return redirect()->route('product.detail', $id)->with('message', 'Product added to your interest list!');
    }

    // Add service to user interest
    public function addInterestedService(string $id): RedirectResponse
    {
        $user = Auth::user();

        $user->interested_services()->syncWithoutDetaching($id);

        return redirect()->route('service.detail', $id)->with('message', 'Service added to your interest list!');
    }

    // Remove product from user interest
    public function destroyInterestedProduct(string $id): RedirectResponse
    {
        $user = Auth::user();
        if ($user->interested_products()->detach($id)) {
            return redirect()->route('user.interests')->with('message', 'Product removed from your list.');
        }
        return redirect()->route('user.interests')->with('error', 'Product not found on your list.');
    }

    // Remove service from user interest
    public function destroyInterestedService(string $id): RedirectResponse
    {
        $user = Auth::user();
        if ($user->interested_services()->detach($id)) {
            return redirect()->route('user.interests')->with('message', 'Service removed from your list.');
        }
        return redirect()->route('user.interests')->with('error', 'Service not found on your list.');
    }
}