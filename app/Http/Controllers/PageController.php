<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a list of all products, grouped by brand.
     */
    public function products(): View
    {
        $products = Product::with(['brand', 'category'])->get();

        $product_data = $products->groupBy('brand.name');

        return view('product', ['product_data' => $product_data]);
    }

    /**
     * Display the details of a single product.
     */
    public function productDetail(string $id): View
    {
        $product = Product::with(['brand', 'category'])->findOrFail($id);

        return view('product_detail', ['product' => $product]);
    }

    /**
     * Display a list of all projects, grouped by category.
     */
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

    /**
     * Display the details of a single project.
     */
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

    /**
     * Display a list of all services, grouped by category.
     */
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

    /**
     * Display the details of a single service.
     */
    public function serviceDetail(string $id): View
    {
        $service = Service::with('category')->findOrFail($id);

        return view('service_detail', ['service' => $service]);
    }
}