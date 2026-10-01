<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = $this->productService->getAll();

        return api_response(
            'success',
            'Products retrieved successfully',
            ProductResource::collection($products)
        );
    }

    public function show(Product $product)
    {
        $product = $this->productService->getById($product);

        return api_response(
            'success',
            'Product retrieved successfully',
            new ProductResource($product)
        );
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->create(
            $request->validated()
        );

        return api_response(
            'success',
            'Product created successfully',
            new ProductResource($product),
            201
        );
    }

    public function update(
        ProductRequest $request,
        Product $product
    ) {
        $product = $this->productService->update(
            $product,
            $request->validated()
        );

        return api_response(
            'success',
            'Product updated successfully',
            new ProductResource($product)
        );
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return api_response(
            'success',
            'Product deleted successfully'
        );
    }
}
