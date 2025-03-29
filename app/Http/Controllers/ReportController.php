<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        return view('report');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        auth()->user()->reports()->create($request->all());

        // Ajoute de l'XP
        $user = auth()->user();
        $user->xp += 1; // Gagne 1 XP par signalement
        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang

        return redirect()->back()->with('success', 'Problème signalé avec succès.');
    }
   
    

   
}