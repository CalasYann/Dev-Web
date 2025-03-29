<?php

use App\Models\Article;

$articles = Article::latest()->take(5)->get();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Acceuil.css') }}">
    <title>{{ config('app.name') }}</title>
</head>
<body>

    <header>
        <h1>Bienvenue sur le site de Woippy</h1>
        <p>Explorez les alentours de notre chaleureuse commune</p>
    </header>

    <!-- Free Tour Section -->
    <section class="articles">
        <h2>Derniers articles</h2>
        <?php foreach ($articles as $article): ?>
            <article>
                <h3><?= htmlspecialchars($article->title) ?></h3>
                <p><?= htmlspecialchars($article->excerpt) ?></p>
                <a href="article.php?id=<?= $article->id ?>">Lire la suite</a>
            </article>
        <?php endforeach; ?>
    </section>

    <!-- Recherche d'information avec filtres -->
    <section>
        <h2>Chercher des informations</h2>
        <form method="GET" action="{{ route('search') }}">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="places">Lieux d'intérêts</option>
                <option value="events">Evenement</option>
                <option value="transport">Horaires de transports</option>
            </select>

            <label for="keyword">Mot-clé:</label>
            <input type="text" name="keyword" id="keyword">

            <button type="submit">rechercher</button>
        </form>
    </section>

    

    <section>
        <h2>si jamais vous avez un problème:</h2>
        <a href="{{ route('report.index') }}">Signaler un problème</a>

    </section> 
    <nav>
        <ul>
            <!-- Vérifie si l'utilisateur est connecté -->
            @if (auth()->check())
                <li><a href="{{ route('profile') }}">Mon profil</a></li>
            @else
                <li><a href="{{ route('login') }}">Se connecter</a></li>
                <li><a href="{{ route('register') }}">S'inscrire</a></li>
            @endif
        </ul>
    </nav>
    

</body>
</html>
