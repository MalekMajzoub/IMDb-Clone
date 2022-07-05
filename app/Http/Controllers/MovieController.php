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
    // Show all movies
    public function index()
    {
        return view('movies.index', [
            'movies' => Movie::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show single movie
    public function show(Movie $movie)
    {
        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    // Manage Movies
    public function manage()
    {
        return view('movies.manage', ['movies' => Movie::latest()->paginate(6)]);
    }

    //Show Edit Form
    public function edit(Movie $movie)
    {
        return view('movies.edit', ['movie' => $movie]);
    }

    // Update Movie
    public function update(Request $request, Movie $movie)
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


    // Show Movie Create Form
    public function create()
    {
        $actors = Actor::all();
        return view('movies.create', ['actors' => $actors]);
    }

    // Store movie data
    public function store(Request $request)
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

        $movie = Movie::create($formFields);

        return redirect('/cms/movies/managemovies');
    }

    // Delete Movie
    public function destroy(Movie $movie)
    {
        File::delete(public_path('storage/' . $movie->logo));
        $movie->delete();
        return redirect('/cms/movies/managemovies');
    }

    // Show Add/Edit Cast Form
    public function addEditActorsForm(Movie $movie)
    {
        $actors = Actor::all();
        return view('movies.cast-edit', ['movie' => $movie, 'actors' => $actors]);
    }

    // Show Add/Edit Cast Form
    public function addEditActors(Request $request, Movie $movie)
    {
        $formFields = $request->validate([
            'character_name' => 'required',
        ]);

        $actor_id = $request->input('id');
        $character_name = $request->input('character_name');
        $hasActor = $movie->actors()->where('actor_id', $actor_id)->exists();
        if ($hasActor)
            return redirect('/cms/movies/' . $movie->id . '/actors');
        $movie->actors()->attach(Actor::find($actor_id), ['character_name' => $character_name]);

        return redirect('/cms/movies/' . $movie->id . '/actors');
    }

    // Show Add/Edit Category Form
    public function addEditCategoriesForm(Movie $movie)
    {
        $categories = Category::all();
        return view('movies.category-edit', ['movie' => $movie, 'categories' => $categories]);
    }

    // Show Add/Edit Category Form
    public function addEditCategories(Request $request, Movie $movie)
    {
        $category_id = $request->input('id');
        $hasCategory = $movie->categories()->where('category_id', $category_id)->exists();
        if ($hasCategory)
            return redirect('/cms/movies/' . $movie->id . '/categories');
        $movie->categories()->attach(Category::find($category_id));

        return redirect('/cms/movies/' . $movie->id . '/categories');
    }

    //Show Rate Form
    public function rate(Movie $movie)
    {
        return view('movies.rate', ['movie' => $movie]);
    }

    // Add Rating of the movie
    public function addRating(Request $request, Movie $movie)
    {
        $rating = $request->input('rating');
        $hasRating = $movie->users()->where('user_id', Auth::id())->exists();
        if ($hasRating) {
            $movie->users()->detach(User::find(Auth::id()));
        }
        $movie->users()->attach(User::find(Auth::id()), ['rating' => $rating]);


        $movie['rating'] = $movie->users()->avg('rating');
        $movie->save();

        return redirect('/movies//' . $movie->id);
    }
}




// $project->user()->attach($users)
