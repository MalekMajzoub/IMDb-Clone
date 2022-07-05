<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    // Manage Actors
    public function manage()
    {
        return view('actors.manage', ['actors' => Actor::all()]);
    }

    // Show Actor Create Form
    public function create()
    {
        return view('actors.create');
    }

    // Store actor data
    public function store(Request $request)
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

        return redirect('/cms/actors/manageactors');
    }

    //Show Edit Form
    public function edit(Actor $actor)
    {
        return view('actors.edit', ['actor' => $actor]);
    }

    // Update Movie
    public function update(Request $request, Actor $actor)
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

        return redirect('/cms/actors/manageactors');
    }

    // Delete Category
    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect('/cms/actors/manageactors');
    }
}
