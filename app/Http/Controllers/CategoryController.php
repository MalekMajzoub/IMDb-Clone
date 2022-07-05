<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Manage Listing
    public function manage()
    {
        return view('categories.manage', ['categories' => Category::all()]);
    }

    // Show Movie Create Form
    public function create()
    {
        return view('categories.create');
    }

    // Store movie data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
        ]);

        Category::create($formFields);

        return redirect('/cms/categories/managecategories');
    }

    //Show Edit Form
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    // Update Movie
    public function update(Request $request, Category $category)
    {
        $formFields = $request->validate([
            'title' => 'required',
        ]);

        $category->update($formFields);

        return redirect('/cms/categories/managecategories');
    }

    // Delete Category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/cms/categories/managecategories');
    }
}
