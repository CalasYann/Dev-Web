<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Place;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Place $place)
    {
        return view('reservations.create', compact('place'));
    }

    public function store(Request $request, Place $place)
    {
        $request->validate([
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ]);

        // Vérifier si le lieu est déjà réservé sur cette plage horaire
        $existingReservation = Reservation::where('place_id', $place->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($existingReservation) {
            return back()->withErrors(['error' => 'Ce lieu est déjà réservé sur cette période.']);
        }

        // Créer la réservation
        Reservation::create([
            'user_id' => auth()->id(),
            'place_id' => $place->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('places.index')->with('success', 'Réservation effectuée avec succès.');
    }

}

