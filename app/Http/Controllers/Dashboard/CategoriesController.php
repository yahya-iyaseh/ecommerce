<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::search($request->search)->showDelete($request->deleteItems)->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        $request->validate([
            'CategoryName' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'Description' => ['string'],
            'image' => ['required', 'mimes:jpg, jpeg, png'],
            'CategoryParent' => ['nullable', 'int', 'exists:categories,id']
        ]);

        $imageName = $request->file('image')->store('public/images');

        Category::create([
            'name' => $request->CategoryName,
            'slug' => Str::slug($request->CategoryName),
            'description' => $request->Description,
            'parent_id' => $request->CategoryParent,
            'image' => $imageName,
        ]);
        notify()->success('Category was created successfully ⚡️');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        dd($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        $request->validate([
            'CategoryName' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($category->id)],
            'Description' => ['string'],
        ]);
        if ($request->hasFile('image')) {

            $imageName = $request->file('image');
            if ($imageName->isValid()) {
                $oldImage = $category->image;
                $imageName = $imageName->store('public/images');
                \Storage::delete($oldImage);
            } else {
                throw ValidationException::withMessages([
                    'image' => 'File crupotted',
                ])->withInput();
            }
        } else {
            $imageName = $category->image;
        }



        $category->update([
            'name' => $request->CategoryName,
            'slug' => Str::slug($request->CategoryName),
            'description' => $request->Description,
            'parent_id' => $request->CategoryParent,
            'image' => $imageName,
        ]);
        notify()->success('The category was upateded successfully');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::withTrashed()->find($id);
        if ($category->trashed()) {
            $oldImage = $category->image;
            $category->forceDelete();
            \Storage::delete($oldImage);
            notify()->success('Delete Category', 'Category deleted Successfully');
            return redirect()->route('dashboard.categories.index');
        } else {
            $category->delete();
            notify()->success('Delete Category', 'Category moved to trash Successfully');
            return redirect()->route('dashboard.categories.index');
        }
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        notify()->success('Category Restore', 'Category was restored successfully');
        return redirect()->route('dashboard.categories.index');
    }
    public function moveImage($image)
    {

        $imageName = time() . '.' . $image->getClientOriginalExtension();
        // dd($imageName);
        $image->move(public_path('images'), $imageName);
    }
}
