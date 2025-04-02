<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    public function index()
    {

       

        // Vérifie si le fichier de logs existe
        $logPath = storage_path('logs/laravel.log');

        $user = auth()->user();
        $user->xp += 1; // Gagne 1 XP par signalement

        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang
        
        if (!File::exists($logPath)) {
            return view('admin.logs', ['logs' => 'Aucun log disponible.']);
        }

        // Récupère le contenu des logs
        $logs = explode("\n", File::get($logPath)); // Divise le fichier log en lignes
        
        return view('admin.logs', compact('logs'));
    }
}
