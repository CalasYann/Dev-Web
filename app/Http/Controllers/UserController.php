<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('role:administrateur'); // Vérifie que l'utilisateur est admin
    }
*/
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

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé');
    }
/*
    public function admin_index()
    {
        $users = User::paginate(10); // Utiliser la pagination
        return view('profile.admin_index', compact('users'));
    }

   

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Synchroniser les rôles
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour');
    }

    public function makeAdmin()
    {
        $user = Auth::user();

        if (!$user->hasRole('administrateur')) {
            $use Spatie\Permission\Models\Role;
            user->assignRole('administrateur');
        }

        return redirect()->back()->with('success', 'Vous êtes maintenant administrateur.');
    }

    public function adminDashboard()
    {
        $users = User::paginate(10); // Paginer pour éviter d'afficher trop d'utilisateurs d'un coup
        return view('admin.dashboard', compact('users'));
    }*/
}
