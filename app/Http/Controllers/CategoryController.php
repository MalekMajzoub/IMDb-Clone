<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequests\StoreCategoryRequest;
use App\Http\Requests\CategoryRequests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function manage() // Manage Listing
    {
        return view('categories.manage', ['categories' => Category::all()]);
    }

    public function create() // Show Movie Create Form
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request) // Store movie data
    {
        $validated = $request->validated();

        Category::create($validated);

        return redirect()->route('categories.manage');
    }

    public function edit(Category $category) //Show Edit Form
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, Category $category) // Update Movie
    {
        $validated = $request->validated();

        $category->update($validated);

        return redirect()->route('categories.manage');
    }

    public function destroy(Category $category) // Delete Category
    {
        $category->delete();
        return redirect()->route('categories.manage');
    }
}
