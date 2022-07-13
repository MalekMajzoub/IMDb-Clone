<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorRequests\StoreActorRequest;
use App\Http\Requests\ActorRequests\UpdateActorRequest;
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

    public function store(StoreActorRequest $request) // Store actor data
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('logos', 'public');
        }

        Actor::create($validated);

        return redirect()->route('actors.manage');
    }

    public function edit(Actor $actor) //Show Edit Form
    {
        return view('actors.edit', ['actor' => $actor]);
    }

    public function update(UpdateActorRequest $request, Actor $actor) // Update Movie
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('logos', 'public');
        }

        $actor->update($validated);

        return redirect()->route('actors.manage');
    }

    public function destroy(Actor $actor) // Delete Category
    {
        $actor->delete();
        return redirect()->route('actors.manage');
    }
}
