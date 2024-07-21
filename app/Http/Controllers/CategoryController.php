<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('dashboard.categories.index', [
            "categories" => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ]);

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;

        if ($request->isActive == null) {
            $category->isActive = 0;
        }else{
            $category->isActive = 1;
        }

        $category->save();
        return redirect()->route('category.index')->with('success', 'category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('dashboard.categories.show',[
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ]);
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;

        if ($request->isActive == null) {
            $category->isActive = 0;
        }else{
            $category->isActive = 1;
        }

        $category->update();
        return redirect()->route('category.index')->with('success', 'category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
                        ->with('success','category deleted successfully');

    }

    public function isActive(Category $category)
    {
        if($category->isActive == 0){
            $category->isActive = 1;
        }
        else{
            $category->isActive = 0;
        }

        $category->save();
        return redirect()->route('category.index')
                        ->with('success','Category Active Status Changed successfully');
    }
}
