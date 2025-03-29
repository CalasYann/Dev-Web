<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté
        return view('profile', compact('user'));
    }
}

