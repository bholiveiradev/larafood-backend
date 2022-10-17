<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private $categoryRepository, $productRepository;

    public function __construct(Category $category, Product $product)
    {
        $this->categoryRepository = $category;
        $this->productRepository  = $product;

        $this->middleware('can:products');
    }

    public function categories($productId)
    {
        $product = $this->productRepository->with('categories')->findOrFail($productId);

        return view('admin.pages.products.categories.index', compact('product'));
    }

    public function available($productId)
    {
        $product = $this->productRepository->findOrFail($productId);

        $categories = $this->categoryRepository->available($product->id)->get();

        return view('admin.pages.products.categories.available', compact('product', 'categories'));
    }

    public function search(Request $request, $productId)
    {
        $product = $this->productRepository->findOrFail($productId);

        $categories = $this->categoryRepository
                           ->available($product->id, $request->text)
                           ->get();

        return view('admin.pages.products.categories.available', compact('product', 'categories'));
    }

    public function attachCategoriesToProduct(Request $request, $productId)
    {
        $product = $this->productRepository->findOrFail($productId);

        $product->categories()->attach($request->categories);

        return redirect()->route('admin.products.categories.index', $product->id);
    }

    public function detachCategoriesToProduct($productId, $categoryId)
    {
        $product = $this->productRepository->findOrFail($productId);

        $product->categories()->detach($categoryId);

        return redirect()->route('admin.products.categories.index', $product->id);
    }
}
