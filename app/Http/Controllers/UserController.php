<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

}

