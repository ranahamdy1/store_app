<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return api_response(
            'success',
            'Categories retrieved successfully',
            CategoryResource::collection($categories)
        );
    }

    public function show(Category $category)
    {
        return api_response(
            'success',
            'Category retrieved successfully',
            new CategoryResource($category)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $category = Category::create($data);

        return api_response(
            'success',
            'Category created successfully',
            new CategoryResource($category),
            201
        );
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'image' => ['sometimes', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $data['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $category->update($data);

        return api_response(
            'success',
            'Category updated successfully',
            new CategoryResource($category)
        );
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return api_response(
            'success',
            'Category deleted successfully'
        );
    }
}
