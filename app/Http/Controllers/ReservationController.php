<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Place;
use Illuminate\Http\Request;
use Carbon\Carbon; // Bibliothèque de la gestion des dates

class ReservationController extends Controller
{
    public function create(Place $place)
    {
        return view('reservations.create', compact('place'));
    }

    public function store(Request $request, Place $place)
    {

        $request->merge([
            'start_time' => Carbon::parse($request->start_time)->format('Y-m-d H:i:s'),
            'end_time' => Carbon::parse($request->end_time)->format('Y-m-d H:i:s'),
        ]);        

        $request->validate([
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ]);

        if (empty($place->horaire_ouverture)) {
            return back()->withErrors(['error' => 'L\'horaire d\'ouverture est manquant pour ce lieu.']);
        }

        $openingHour = Carbon::createFromFormat('H:i', trim($place->horaire_ouverture));
        $closingHour = Carbon::createFromFormat('H:i', trim($place->horaire_fermeture));

        $startdate = Carbon::createFromFormat('Y-m-d H:i:s', trim($request->start_time));
        $enddate = Carbon::createFromFormat('Y-m-d H:i:s', trim($request->start_time));

        if ($startdate->format('H:i') < $openingHour->format('H:i') || $enddate->format('H:i') > $closingHour->format('H:i')) {
            return back()->withErrors([
                'error' => "La réservation doit être dans les horaires d’ouverture (de {$openingHour->format('H:i')} à {$closingHour->format('H:i')})."
            ]);
        }

        $startTime = $startdate ->format('H:i');
        $endTime = $startdate ->format('H:i');

        $reservationExistante = Reservation::where('place_id', $place->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    // Vérifie si la nouvelle réservation commence avant la fin d'une ancienne réservation
                    ->orWhere(function($query) use ($request) {
                        $query->where('start_time', '<', $request->end_time)
                            ->where('end_time', '>', $request->start_time);
                    });
            })
            ->exists();
        if ($reservationExistante) {
            return back()->withErrors(['error' => 'Ce lieu est déjà réservé sur cette période.']);
        }

        // Créer la réservation
        Reservation::create([
            'user_id' => auth()->id(),
            'place_id' => $place->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
         // Ajoute de l'XP
         $user = auth()->user();
         $user->xp += 1; // Gagne 1 XP par signalement
         $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang
        return redirect()->route('places.index')->with('success', 'Réservation effectuée avec succès.');
    }

    public function myReservations(){
        $user = auth()->user();

        $res=$user->reservations()
            ->where('start_time','>', now())
            ->orderBy('start_time','asc')
            ->get();

        return view('reservations.index', compact('res'));
    }

    public function destroy(Reservation $res){
        if(auth()->id() !== $res->user_id){
            abort(403, 'Accès non autorisé');
        }

        $res->delete();
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée');
    
    }

}

