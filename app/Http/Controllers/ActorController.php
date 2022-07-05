<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function manage() // Manage Actors
    {
        return view('actors.manage', ['actors' => Actor::all()]);
    }

    public function create() // Show Actor Create Form
    {
        return view('actors.create');
    }

    public function store(Request $request) // Store actor data
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'image' => 'sometimes',
            'dob' => ['required', 'date'],
            'nationality' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('logos', 'public');
        }

        Actor::create($formFields);

        return redirect()->route('actors.manage');
    }

    public function edit(Actor $actor) //Show Edit Form
    {
        return view('actors.edit', ['actor' => $actor]);
    }

    public function update(Request $request, Actor $actor) // Update Movie
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'image' => 'sometimes',
            'dob' => ['required', 'date'],
            'nationality' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('logos', 'public');
        }

        $actor->update($formFields);

        return redirect()->route('actors.manage');
    }

    public function destroy(Actor $actor) // Delete Category
    {
        $actor->delete();
        return redirect()->route('actors.manage');
    }
}
