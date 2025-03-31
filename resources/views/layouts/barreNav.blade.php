<?php

use App\Models\Article;

$articles = Article::latest()->take(5)->get();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/WelcomeCSS.css') }}">
    <title>Ville de Croisée</title>
</head>
<body>

    <header>
        <h1>La Ville de Croisée</h1>

        <a href="{{ route('register') }}">
             <button>Se connecter</button>
        </a>
    </header>
    <nav>
        <a href="{{ url('/') }}">
            <button>ACCUEIL</button>
        </a>
        <a href="{{ route('events.index') }}">
            <button>ÉVÈNEMENT</button>
        </a>
        <a href="{{ route('places.index') }}">
            <button>DÉCOUVRIR</button>
        </a>
        <a href="{{ route('reservations.index') }}">
            <button>RÉSERVATION</button>
        </a>
        <a href="{{ route('object_co.index') }}">
            <button>🔌 Objets Connectés</button>
        </a>
        @if(auth()->check())
            <a href="{{ route('profile.show', ['user' => auth()->user()->id]) }}">Voir mon profil</a>
        @endif
    </nav>

    <div class="container">
        @yield('content') <!-- Le contenu des pages s'affichera ici -->
    </div>

</body>
</html>