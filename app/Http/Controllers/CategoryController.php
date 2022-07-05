<?php

namespace App\Http\Controllers;

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

    public function store(Request $request) // Store movie data
    {
        $formFields = $request->validate([
            'title' => 'required',
        ]);

        Category::create($formFields);

        return redirect()->route('categories.manage');
    }

    public function edit(Category $category) //Show Edit Form
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category) // Update Movie
    {
        $formFields = $request->validate([
            'title' => 'required',
        ]);

        $category->update($formFields);

        return redirect()->route('categories.manage');
    }

    public function destroy(Category $category) // Delete Category
    {
        $category->delete();
        return redirect()->route('categories.manage');
    }
}
