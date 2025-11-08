<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Product::with(['images', 'features', 'specifications']);

        if ($request->has('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 12);
        $products = $query->paginate($perPage);

        $products->getCollection()->transform(function ($product) {
            return $this->formatProduct($product);
        });

        return $this->successResponse($products);
    }

    public function show($id)
    {
        $product = Product::with(['images', 'features', 'specifications'])->find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', null, 404);
        }

        return $this->successResponse($this->formatProduct($product));
    }

    public function categories()
    {
        $categories = \App\Models\Category::select('id', 'name', 'slug', 'image')->get();
        
        $formattedCategories = [
            ['name' => 'All', 'slug' => 'all', 'image' => null]
        ];
        
        foreach ($categories as $category) {
            $formattedCategories[] = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'image' => $category->image,
            ];
        }

        return $this->successResponse($formattedCategories);
    }

    private function formatProduct($product)
    {
        $specifications = [];
        foreach ($product->specifications as $spec) {
            $specifications[$spec->key] = $spec->value;
        }

        return [
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'price' => (string) $product->price,
            'image' => $product->image,
            'category' => $product->category,
            'rating' => $product->rating,
            'reviews_count' => $product->reviews_count,
            'in_stock' => $product->in_stock,
            'images' => $product->images->pluck('image_url')->toArray(),
            'features' => $product->features->pluck('feature')->toArray(),
            'specifications' => $specifications,
        ];
    }
}
