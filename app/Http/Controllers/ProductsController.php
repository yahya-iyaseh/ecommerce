<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index($category_id = null){
        if($category_id){
            $category = Category::findOrFail($category_id);
            return view('store.products.index', ['category' => $category, 'products' => $category->products->paginate()]);
        }
        $products = Product::latest()->paginate();

        return view('store.products.index', ['category' => new Category, 'products' => $products]);
    }
}
