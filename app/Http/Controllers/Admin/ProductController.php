<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Product::with(['images', 'features', 'specifications']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Stock filter
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'in_stock') {
                $query->where('in_stock', true);
            } elseif ($request->stock_status === 'out_of_stock') {
                $query->where('in_stock', false);
            }
        }

        $perPage = $request->get('per_page', 15);
        $products = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        if ($request->expectsJson()) {
            return $this->successResponse($products);
        }

        // Get unique categories for filter dropdown
        $categories = Product::distinct()->pluck('category')->filter()->sort()->values();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('products', 'public');
            $data['image'] = Storage::url($imagePath);
        }
        
        $product = Product::create($data);

        // Handle images
        if ($request->has('images')) {
            foreach ($request->images as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imageUrl,
                    'is_primary' => $index === 0,
                    'order' => $index,
                ]);
            }
        }

        // Handle features
        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                ProductFeature::create([
                    'product_id' => $product->id,
                    'feature' => $feature,
                ]);
            }
        }

        // Handle specifications
        if ($request->has('specifications')) {
            foreach ($request->specifications as $key => $value) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'key' => $key,
                    'value' => $value,
                ]);
            }
        }

        if ($request->expectsJson()) {
            return $this->successResponse($product->load(['images', 'features', 'specifications']), 'Product created successfully', 201);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function show(Request $request, $id)
    {
        $product = Product::with(['images', 'features', 'specifications'])->find($id);

        if (!$product) {
            if ($request->expectsJson()) {
                return $this->errorResponse('Product not found', null, 404);
            }
            abort(404);
        }

        if ($request->expectsJson()) {
            return $this->successResponse($product);
        }

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::with(['images', 'features', 'specifications'])->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image_file')) {
            // Delete old image if it's a stored file
            if ($product->image && strpos($product->image, '/storage/') !== false) {
                $oldPath = str_replace('/storage/', '', $product->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $imagePath = $request->file('image_file')->store('products', 'public');
            $data['image'] = Storage::url($imagePath);
        }
        
        $product->update($data);

        if ($request->expectsJson()) {
            return $this->successResponse($product->load(['images', 'features', 'specifications']), 'Product updated successfully');
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        if ($request->expectsJson()) {
            return $this->successResponse(null, 'Product deleted successfully');
        }

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
