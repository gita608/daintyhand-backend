<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $categories = Category::orderBy('created_at', 'desc')->paginate($perPage);
        
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
        $category = Category::create($request->validated());
        
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
        $category->update($request->validated());
        
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
