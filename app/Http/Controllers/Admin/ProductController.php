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

class ProductController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $products = Product::with(['images', 'features', 'specifications'])
            ->paginate($perPage);

        if ($request->expectsJson()) {
            return $this->successResponse($products);
        }

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

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
        $product->update($request->validated());

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
