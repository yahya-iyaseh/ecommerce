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

            return view('store.products.index', ['category' => $category, 'products' => $category->products()->latest()->paginate(12)]);
        }
        // Eager Loading
        $products = Product::latest()->paginate(12);

        return view('store.products.index', ['category' => new Category, 'products' => $products]);
    }
    public function show(Category $category, Product $product)
    {
        return view('store.products.show', compact('category', 'product'));
    }
    public function review(Request $request, Product $product)
    {
        dd($product);

        $request->validate([
            'rating' => ['required', 'int', 'min:1', 'max:5'],
            'review' => ['nullable', 'string']
        ]);
        // $review = Review::create([
        //     'reviewable_type' => Product::class,
        //     'reviewable_id' => $product->id,
        //     'user_id' => Auth::id(),
        //     'rating' => $request->post('rating'),
        //     'review' => $request->post('review'),
        // ]);

        $product->reviews()->create([
            'rating' => $request->post('rating'),
            'review' => $request->post('review'),
        ]);

        return redirect()->to($product->url)->with('success', __('Product reviewd'));
    }
}
