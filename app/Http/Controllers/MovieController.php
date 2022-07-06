<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    public function index() // Show all movies
    {
        return view('movies.index', [
            'movies' => Movie::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function show(Movie $movie) // Show single movie
    {
        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    public function manage() // Manage Movies
    {
        return view('movies.manage', ['movies' => Movie::latest()->paginate(6)]);
    }

    public function edit(Movie $movie) // Show Edit Form
    {
        return view('movies.edit', ['movie' => $movie]);
    }

    public function update(Request $request, Movie $movie) // Update Movie
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'logo' => 'sometimes',
            'trailer' => 'sometimes',
            'release_date' => ['required', 'date'],
            'production_date' => ['required', 'date'],
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $movie->update($formFields);

        return redirect()->route('movies.manage');
    }

    public function create() // Show Movie Create Form
    {
        $actors = Actor::all();
        return view('movies.create', ['actors' => $actors]);
    }

    public function store(Request $request) // Store movie data
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'logo' => 'sometimes',
            'trailer' => 'sometimes',
            'release_date' => ['required', 'date'],
            'production_date' => ['required', 'date'],
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Movie::create($formFields);

        return redirect()->route('movies.manage');
    }

    public function destroy(Movie $movie) // Delete Movie
    {
        File::delete(public_path('storage/' . $movie->logo));
        $movie->delete();
        return redirect()->route('movies.manage');
    }

    public function addEditActorsForm(Movie $movie) // Show Add/Edit Actors Form
    {
        $actors = Actor::all();
        return view('movies.cast-edit', ['movie' => $movie, 'actors' => $actors]);
    }

    public function addEditActors(Request $request, Movie $movie) // Add/Edit Actors
    {
        $request->validate([
            'character_name' => 'required',
        ]);

        $actor_id = $request->input('id');
        $character_name = $request->input('character_name');
        // $hasActor = $movie->actors()->where('actor_id', $actor_id)->exists();
        // if ($hasActor)
        //     return redirect('/cms/movies/' . $movie->id . '/actors');
        $movie->actors()->attach(Actor::find($actor_id), ['character_name' => $character_name]);

        return redirect()->route('movies.addEditActorsForm', ['movie' => $movie->id]);
    }

    public function destroyActors(Movie $movie, Actor $actor)
    {
        $movie->actors()->detach(Actor::find($actor->id));
        return redirect()->route('movies.addEditActorsForm', ['movie' => $movie->id]);
    }

    public function addEditCategoriesForm(Movie $movie) // Show Add/Edit Category Form
    {
        $categories = Category::all();
        return view('movies.category-edit', ['movie' => $movie, 'categories' => $categories]);
    }

    public function addEditCategories(Request $request, Movie $movie) // Add/Edit Category 
    {
        $category_id = $request->input('id');
        $hasCategory = $movie->categories()->where('category_id', $category_id)->exists();
        if ($hasCategory)
            return redirect('/cms/movies/' . $movie->id . '/categories');
        $movie->categories()->attach(Category::find($category_id));

        return redirect()->route('movies.addEditCategories', ['movie' => $movie->id]);
    }

    public function destroyCategories(Movie $movie, Category $category)
    {
        $movie->categories()->detach(Category::find($category->id));
        return redirect()->route('movies.addEditCategoriesForm', ['movie' => $movie->id]);
    }

    public function rate(Movie $movie) //Show Rate Form
    {
        return view('movies.rate', ['movie' => $movie]);
    }

    public function addRating(Request $request, Movie $movie) // Add Rating of the movie
    {
        $rating = $request->input('rating');
        $hasRating = $movie->users()->where('user_id', Auth::id())->exists();
        if ($hasRating) {
            $movie->users()->detach(User::find(Auth::id()));
        }
        $movie->users()->attach(User::find(Auth::id()), ['rating' => $rating]);


        $movie['rating'] = $movie->users()->avg('rating');
        $movie->save();

        return redirect()->route('movies.show', ['movie' => $movie->id]);
    }
}
