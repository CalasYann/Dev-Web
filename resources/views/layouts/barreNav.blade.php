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
        <a href="{{ route('events.index') }}">
            <button>ANNONCES</button>
        </a>
        <a href="{{ route('places.index') }}">
            <button>DÉCOUVRIR</button>
        </a>
    </nav>

    <div class="container">
        @yield('content') <!-- Le contenu des pages s'affichera ici -->
    </div>

</body>
</html>