<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class ProfileController extends Controller {
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Vérifier si l'utilisateur est bien le propriétaire du profil ou un admin
        if (auth()->user()->id !== $user->id && !auth()->user()->hasRole('admin')) {
            abort(403, 'Accès interdit');
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'age'=>'required|integer|min:0',
            'metier'=>'required|string|max:255',
            'prenom'=>'required|string|max:255'
        ]);

        $user->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'age' =>$request->age,
            'metier' =>$request->metier,
        ]);

        // Si un nouveau mot de passe est fourni, on le met à jour

        $user->save();

        return redirect()->route('profile.show', $user)->with('success', 'Profil mis à jour !');
    }
}
