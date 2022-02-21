<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:sanctum']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(2);
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if I want to check if the user have abilites
        // $user = Auth::guard('sanctum')->user();
        // if(!$user->tokenCan('categories.create')){
        //     abort(403, 'Hello I catch you');
        // }
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')],
            'parent_id' => ['nullable', 'numeric', 'exists:categories,id'],
        ]);
        $category = Category::create($request->all());
        return response($category, 201, [
            // to send new header x-withHeadername
            'x-server-message' => "hello man",
        ]);
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::findOrFail($id)->load('products');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255', 'unique:categories,name'],
            'parent_id' => ['sometimes', 'required', 'numeric', 'exists:categories,id'],
        ]);
        $category->updateOrFail($request->all());

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

         $category = Category::findOrFail($id);
         $category->delete();
        return [
            'message' => __('Category Deletted'),
        ];
    }
}
