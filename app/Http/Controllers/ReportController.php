<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Log;  



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


        Log::info('User XP before upgrade: ' . $user->xp);
        Log::info('User roles before upgrade: ' . implode(', ', $user->getRoleNames()->toArray()));

        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang

        Log::info( 'User  XP after upgrade: ' . $user->name);
        Log::info('User roles after upgrade: ' . implode(', ', $user->getRoleNames()->toArray()));

        return redirect()->back()->with('success', 'Problème signalé avec succès.');
    }
   
    

   
}