<?php
// app/Http/Controllers/PlaceController.php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all(); // Récupère tous les lieux
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
            'affluence' => 'nullable|integer|min:0',
            'horaire_ouverture' => 'nullable|date_format:H:i',
            'horaire_fermeture' => 'nullable|date_format:H:i',
        ]);

        // Création d'un nouveau lieu
        Place::create($request->all());

        return redirect()->route('places.index'); // Rediriger vers la page d'index après la création
    }
}
