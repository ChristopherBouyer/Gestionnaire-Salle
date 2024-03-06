<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'badge' => 'required|unique:users|max:25',
        ]);

        $newuser = User::create([
            'name' => $request->name,
            'badge' => $request->badge,
        ]);

        return redirect('/user')->with('success', 'Utilisateur ajouté avec succès!');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|unique:users,name,' . $user->id,
            'badge' => 'unique:users,badge,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'badge' => $request->badge,
        ]);

        return redirect('/user')->with('success', 'Utilisateur mis à jour avec succès!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/user')->with('success', 'Utilisateur supprimé avec succès!');
    }
}
