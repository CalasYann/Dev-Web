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

        @if(!auth()->check())
            <a href="{{ route('login') }}">Se connecter</a>
        @endif
        @if(auth()->check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"> Se décaloter</button>
            </form>
        @endif
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
        <a href="{{ route('users.index') }}">
            <button>CHERCHER DES HABITANTS</button>
        </a>
        @if(auth()->check())
            <a href="{{ route('profile.show',  auth()->user()->id) }}">
                <button>Voir mon profil</button>
            </a>
        @endif
    </nav>

    <div class="container">
        @yield('content') <!-- Le contenu des pages s'affichera ici -->
    </div>

</body>
</html>