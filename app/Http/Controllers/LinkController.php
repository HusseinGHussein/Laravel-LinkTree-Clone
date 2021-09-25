<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        return view('links.index', [
            'links' => auth()->user()
                ->links()
                ->with(['latestVisit'])
                ->withCount('visits')
                ->get()
        ]);
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ]);

        auth()->user()->links()->create($attributes);

        return redirect()->route('links.index');
    }

    public function show(Link $link)
    {
        //
    }

    public function edit(Link $link)
    {
        abort_if(auth()->id() != $link->user_id, 403);

        return view('links.edit', [
            'link' => $link
        ]);
    }

    public function update(Request $request, Link $link)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ]);

       $link->update($attributes);

        return redirect()->route('links.index');
    }

    public function destroy(Link $link)
    {
        abort_if(auth()->id() != $link->user_id, 403);

        $link->delete();

        return redirect()->route('links.index');
    }
}
