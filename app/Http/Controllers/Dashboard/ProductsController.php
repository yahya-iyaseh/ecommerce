<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::latest()->search($request->search)->showDelete($request->deleteItems)->paginate();
        return view(
            'products.index',
            compact('products')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
            'product' => new Product(),
            'availability' => Product::availability(),
            'getStatus' => Product::getStatus(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        $this->validate($request, $this->rules());
        $imageName = $request->file('image')->store('public/products');
        $data['image'] = $imageName;
        $data['slug'] = Str::slug($data['name']);
        $product = Product::create($data);
        notify()->success('Create Product', "Product ({$product->name}) created successfully");
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view(
            'products.edit',
            [
                'product' => $product,
                'availability' => Product::availability(),
                'getStatus' => Product::getStatus(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, $this->rules($product->id));
        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('public/products');
            $oldImage = $product->image;
        } else {
            $newImage = $product->image;
        }
        $data = $request->except('image');
        $data['image'] = $newImage;
        $product->update($data);
        if(isset($oldImage)){
            \Storage::delete($oldImage);
        }
        notify()->success('Update Product', "Product ({$product->name}) updated successfully");
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($product->trashed()) {
            $product->forceDelete();
            notify()->success('Delete Product', "Product ({$product->name}) was successfully Deleted");
            return redirect()->route('dashboard.products.index');
        } else {

            $product->delete();
            notify()->success('Remove Product', "Product ({$product->name}) was successfully Removed");
            return redirect()->route('dashboard.products.index');
        }
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();
        notify()->success('Restore Product', "Product ({$product->name}) was successfully restored");
        return redirect()->route('dashboard.products.index');
    }

    public function rules($id = null)
    {
        if ($id) {
            $required = 'nullable';
        } else {
            $required = 'required';
        }
        // $id != null ?? $required = 'nullable' | 'required';
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($id)],
            'category_id' => ['required', 'int', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0',],
            'compare_price' => ['nullable', 'numeric', 'gt:price'],
            'status' => ['in:active,draft,archived',],
            'availability' => ['in:in-stock,out-of-stock,back-order',],
            'quantity' => ['nullable', 'int', 'min:0'],
            'sku' => ['nullable', 'string', Rule::unique('products', 'sku')->ignore($id)],
            'barcode' => ['nullable', 'string', Rule::unique('products', 'barcode')->ignore($id)],
            'image' => [$required, 'image'],
        ];
    }
}
