<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return view('welcome');
    }

    public function home()
{
    $events = Event::orderBy('date', 'asc')->get();
    return view('welcome', compact('events')); // Assure-toi que le fichier Blade est bien "home.blade.php"
}

}
