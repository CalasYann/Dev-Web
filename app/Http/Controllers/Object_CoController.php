<?php

namespace App\Http\Controllers;

use App\Models\Object_Co;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;


class Object_CoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objects = Object_Co::all();
        return view('object_co.index',compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('object_co.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => ['required', Rule::in(Object_Co::getStatusOptions())],
            'location' => 'nullable|string',
            'consommation_par_heure' => 'required|numeric|min:0',
        ]);

        Object_Co::create($request->all());
        $user = auth()->user();
        $user->xp += 1; // Gagne 1 XP par signalement

        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang

        return redirect()->route('object_co.index')->with('success', 'Objet connecté ajouté avec succès.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Object_Co $object_co)
    {
        return view('object_co.edit', compact('object_co'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Object_Co $object_co)
{
    $object_co->interaction();
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'status' => ['required', Rule::in(Object_Co::getStatusOptions())],
        'location' => 'nullable|string',
        'consommation_par_heure' => 'required|numeric|min:0',
    ]);

    $object_co->update($request->all());

    return redirect()->route('object_co.index')->with('success', 'Objet connecté mis à jour.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Object_CO $object_co)
    {
        $object_co->delete();
        $user = auth()->user();
        $user->xp += 1; // Gagne 1 XP par signalement

        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang
        return redirect()->route('object_co.index')->with('success', 'Objet supprimé.');
    }
    public function start($id)
    {
        $object = Object_Co::findOrFail($id);
        $object->allumer(); // Allumer l'objet
        return redirect()->route('object_co.show', $id);
    }

    public function stop($id)
    {
        $object = Object_Co::findOrFail($id);
        $object->eteindre(); // Éteindre l'objet
        return redirect()->route('object_co.show', $id);
    }

    public function rapport()
    {
        $objects = Object_Co::all(); // Récupère tous les objets connectés

        return view('rapport', compact('objects')); // Passe les objets à la vue
    }



    public function genererRapportPDF()
    {
        $objects = Object_Co::all();

        // Générer le PDF avec la vue correspondante
        $pdf = PDF::loadView('rapport_pdf', compact('objects'));

        $user = auth()->user();
        $user->xp += 1; // Gagne 1 XP par signalement

        $user->checkRankUpgrade(); // Vérifie si l'utilisateur doit monter de rang

        // Télécharger le fichier PDF
        return $pdf->download('rapport-objets-connectes.pdf');
    }
}
