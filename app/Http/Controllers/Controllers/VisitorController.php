<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Event;
use App\Models\Transport;

class VisitorController extends Controller
{
    public function index()
    {
        // Récupérer des informations locales comme les lieux d'intérêt, événements, etc.
        $placesOfInterest = Place::all();  // Exemple de récupération de données
        $events = Event::all();            // Récupération des événements
        $transportSchedules = Transport::all();  // Horaires des transports

        return view('welcome', compact('placesOfInterest', 'events', 'transportSchedules'));
    }
    public function search(Request $request)
    {
        $category = $request->input('category');
        $keyword = $request->input('keyword');

        // Filtrer les données en fonction des critères
        if ($category == 'places') {
            $results = Place::where('name', 'like', "%$keyword%")->get();
        } elseif ($category == 'events') {
            $results = Event::where('name', 'like', "%$keyword%")->get();
        } else {
            $results = Transport::where('route', 'like', "%$keyword%")->get();
        }

        return view('search_results', compact('results'));
    }

}


