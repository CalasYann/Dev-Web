<?php

namespace App\Http\Controllers;

use App\Models\IotDevice;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = IotDevice::all();
        return view('object.index',compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('object.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'type'=>'required|string|max:255',
            'status'=> ['required', Rule::in(Objects::getStatusOptions())],
            'location'=>'nullable|string',
        ]);

        Objects::create($request->all());

        return redirect()->route('object.index')->with('sucess', 'Object connecté ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Objects $device)
    {
        return view('object.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Objects $device)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
