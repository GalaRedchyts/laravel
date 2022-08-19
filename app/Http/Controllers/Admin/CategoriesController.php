<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('admin/categories/index', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('status', "The category #{$request->id} was successfully created!");
    }


    public function edit(Category $category)
    {
        return view('admin/categories/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        Category::where('id', '=', $category->id)->update($data);

        return redirect()->route('admin.categories.index')
            ->with('status', "The category #{$request->id} was successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->products()->delete();
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('status', "The category #{$category->id} was successfully deleted!");
    }

    public function productsOfCategory(Request $request)
    {
        $products = Product::where('category_id', '=', $request->id)->paginate(10);

        return view('admin/categories/categoryProducts', compact('products'));
    }
}
