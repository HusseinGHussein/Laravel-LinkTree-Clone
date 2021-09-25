<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user->load('links')
        ]);
    }

    public function edit()
    {
        return view('users.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $atrributes = $request->validate([
            'background_color' => ['required', 'size:7', 'starts_with:#'],
            'text_color' => ['required', 'size:7', 'starts_with:#'],
        ]);

        auth()->user()->update($atrributes);

        return back();
    }
}
