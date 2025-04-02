<?php
// app/Http/Controllers/PlaceController.php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Place::query();

        // Filtrer par type
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filtrer par affluence (minimum)
        if ($request->filled('affluence_min')) {
            $query->where('affluence', '>=', $request->input('affluence_min'));
        }

        // Filtrer par affluence (maximum)
        if ($request->filled('affluence_max')) {
            $query->where('affluence', '<=', $request->input('affluence_max'));
        }

        // Filtrer par horaires d'ouverture
        if ($request->filled('horaire_ouverture')) {
            $query->where('horaire_ouverture', '<=', $request->input('horaire_ouverture'));
        }

        // Filtrer par horaires de fermeture
        if ($request->filled('horaire_fermeture')) {
            $query->where('horaire_fermeture', '>=', $request->input('horaire_fermeture'));
        }

        // Récupération des lieux filtrés
        $places = $query->get();

        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string|max:255',
            'affluence' => 'nullable|integer|min:0|max:5',
            'horaire_ouverture' => 'nullable|date_format:H:i',
            'horaire_fermeture' => 'nullable|date_format:H:i',
        ]);

        // Création d'un nouveau lieu
        Place::create($request->all());
        $user = auth()->user();
        $user->xp += 1; // Gagne 1 XP par signalement

        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang

        return redirect()->route('places.index'); // Rediriger vers la page d'index après la création
    }
        // Afficher le formulaire d'édition
    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    // Mettre à jour un lieu
    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'affluence' => 'nullable|integer|min:0|max:5',
            'horaire_ouverture' => 'required',
            'horaire_fermeture' => 'required',
        ]);

        $place->update($request->all());

        return redirect()->route('places.index')->with('success', 'Lieu mis à jour avec succès.');
    }

    // Supprimer un lieu
    public function destroy(Place $place)
    {
        $place->delete();
        $user = auth()->user();
        $user->xp += 1; // Gagne 1 XP par signalement

        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang
        return redirect()->route('places.index')->with('success', 'Lieu supprimé avec succès.');
    }

    public function add_places()
    {
        return view('admin.add_places');
    }

    public function getOpeningTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getClosingTimeAttribute($value)
    {
        return Carbon::parse($value);
    }
}
