<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Log;  
use Spatie\Permission\Models\Role;




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
   
    public function showReports()
{
    $reports = Report::latest()->paginate(10);
    return view('admin.reports', compact('reports'));
}
    
public function destroy(Report $report)
{
    // Vérifie si l'utilisateur est administrateur
    if (!auth()->user()->hasRole('administrateur')) {
        return redirect()->route('admin.reports')->with('error', 'Accès refusé.');
    }

    $report->delete(); // Supprime le signalement

    return redirect()->route('admin.reports')->with('success', 'Signalement supprimé avec succès.');
}


   
}