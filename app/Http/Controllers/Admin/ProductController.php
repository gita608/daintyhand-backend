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

        return $this->successResponse($products);
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

        return $this->successResponse($product->load(['images', 'features', 'specifications']), 'Product created successfully', 201);
    }

    public function show($id)
    {
        $product = Product::with(['images', 'features', 'specifications'])->find($id);

        if (!$product) {
            return $this->errorResponse('Product not found', null, 404);
        }

        return $this->successResponse($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return $this->successResponse($product->load(['images', 'features', 'specifications']), 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return $this->successResponse(null, 'Product deleted successfully');
    }
}
