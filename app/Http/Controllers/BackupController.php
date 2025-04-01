<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function backup()
    {
        // Définir le chemin vers ta base de données SQLite
        $databasePath = database_path('database.sqlite');
        // Définir le chemin où sauvegarder le fichier de la base
        $backupPath = storage_path('app/backups');
        
        // Créer le dossier des sauvegardes s'il n'existe pas
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0777, true, true);
        }

        // Nom du fichier de la sauvegarde
        $backupFileName = 'backup_' . Carbon::now()->format('Y_m_d_H_i_s') . '.sqlite';
        $backupFilePath = $backupPath . '/' . $backupFileName;

        // Copier le fichier SQLite
        File::copy($databasePath, $backupFilePath);

        return redirect()->back()->with('message', 'Database backup created successfully!');
    }
}
