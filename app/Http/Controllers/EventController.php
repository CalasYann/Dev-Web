<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('date', 'asc')->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("events.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "nom"=>'required|string|max:255',
            'date'=>['required', 'date','after_or_equal:' . Carbon::today()->format('Y-m-d')],
            'description'=>'string',
            'adresse'=>'required|string|max:255',
        ]);


        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Evenelent ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact("event"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            "nom"=>'required|string|max:255',
            'date'=>"required|date",
            'description'=>'string',
            'adresse'=>'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Evenement mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evenement supprimé');
    }
}
