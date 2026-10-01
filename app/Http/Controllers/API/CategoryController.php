<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    public function index()
    {
        $categories = $this->categoryService->getAll();

        return api_response(
            'success',
            'Categories retrieved successfully',
            CategoryResource::collection($categories)
        );
    }

    public function show(Category $category)
    {
        $category = $this->categoryService->getById($category);

        return api_response(
            'success',
            'Category retrieved successfully',
            new CategoryResource($category)
        );
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->create(
            $request->validated()
        );

        return api_response(
            'success',
            'Category created successfully',
            new CategoryResource($category),
            201
        );
    }

    public function update(
        CategoryRequest $request,
        Category $category
    ) {
        $category = $this->categoryService->update(
            $category,
            $request->validated()
        );

        return api_response(
            'success',
            'Category updated successfully',
            new CategoryResource($category)
        );
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return api_response(
            'success',
            'Category deleted successfully'
        );
    }
}
