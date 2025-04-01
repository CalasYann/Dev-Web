<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::query();

        if ($request->filled('name')) {
            $users->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('prenom')) {
            $users->where('prenom', 'like', '%' . $request->prenom . '%');
        }

        if ($request->filled('adresse')) {
            $users->where('adresse', 'like', '%' . $request->adresse . '%');
        }

        if ($request->filled('age')) {
            $users->where('age', $request->age);
        }

        if ($request->filled('metier')) {
            $users->where('metier', 'like', '%' . $request->metier . '%');
        }

        $users = $users->paginate(10);


        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->update($request->only(['name', 'email']));
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé.');
    }
   
    
    public function adminDashboard()
{
    $users = User::paginate(10); // Liste paginée des utilisateurs
    return view('admin.users', compact('users'));
}

public function admin_index()
{
    $users = User::paginate(10);
    return view('admin.users.index', compact('users'));
}

public function updateRoles(Request $request, User $user)
{
    $request->validate([
        'roles' => 'array', // Assure-toi que c'est bien un tableau de rôles
        'roles.*' => 'string|exists:roles,name' // Vérifie que les rôles existent
    ]);

    // Synchronise les rôles avec ceux sélectionnés dans le formulaire
    $user->syncRoles($request->roles);

    return redirect()->route('admin.users')->with('success', 'Rôles mis à jour avec succès.');
}


}