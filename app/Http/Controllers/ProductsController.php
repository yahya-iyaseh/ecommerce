<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Category $category = null)
    {
        if ($category) {

            return view('store.products.index', ['category' => $category, 'products' => $category->products()->latest()->paginate(10)]);
        }
        // Eager Loading
        $products = Product::latest()->paginate(10);

        return view('store.products.index', ['category' => new Category, 'products' => $products]);
    }
    public function show(Category $category, Product $product)
    {
        return view('store.products.show', compact('category', 'product'));
    }
}
