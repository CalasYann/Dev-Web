<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Place;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create($place_id)
    {
        $place = Place::findOrFail($place_id);
        return view('reservations.create', compact('place'));
    }

    public function store(Request $request, $place_id)
    {
        $request->validate([
            'reservation_time' => 'required|date',
        ]);

        $reservation = new Reservation();
        $reservation->user_id = auth()->id(); // L'utilisateur authentifié
        $reservation->place_id = $place_id; // Le lieu réservé
        $reservation->reservation_time = $request->reservation_time;
        $reservation->save();

        return redirect()->route('places.index')->with('success', 'Réservation réussie!');
    }
}

