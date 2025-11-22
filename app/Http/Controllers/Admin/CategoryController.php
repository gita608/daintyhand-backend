<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Category::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 15);
        $categories = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
        
        if ($request->expectsJson()) {
            return $this->successResponse($categories);
        }
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('categories', 'public');
            $data['image'] = Storage::url($imagePath);
        }
        
        $category = Category::create($data);
        
        if ($request->expectsJson()) {
            return $this->successResponse($category, 'Category created successfully', 201);
        }
        
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image_file')) {
            // Delete old image if it's a stored file
            if ($category->image && strpos($category->image, '/storage/') !== false) {
                $oldPath = str_replace('/storage/', '', $category->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $imagePath = $request->file('image_file')->store('categories', 'public');
            $data['image'] = Storage::url($imagePath);
        }
        
        $category->update($data);
        
        if ($request->expectsJson()) {
            return $this->successResponse($category, 'Category updated successfully');
        }
        
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        if ($request->expectsJson()) {
            return $this->successResponse(null, 'Category deleted successfully');
        }
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
