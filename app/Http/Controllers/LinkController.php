<?php

namespace App\Http\Controllers;

use App\Http\Requests\Links;
use App\Models\Link;

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

    public function store(Links\StoreLinkRequest $request)
    {
        auth()->user()->links()->create($request->validated());

        return redirect()->route('links.index');
    }

    public function show(Link $link)
    {
        //
    }

    public function edit(Link $link)
    {
        $this->authorize('update', $link);

        return view('links.edit', [
            'link' => $link
        ]);
    }

    public function update(Links\UpdateLinkRequest $request, Link $link)
    {
       $link->update($request->validated());

        return redirect()->route('links.index');
    }

    public function destroy(Link $link)
    {
        $this->authorize('forceDelete', $link);

        $link->delete();

        return redirect()->route('links.index');
    }
}
