<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>
<body>

    <header>
        <h1>Bienvenu sur le site de Woippy</h1>
        <p>Explorer les alentours de notre chalereuse commune</p>
    </header>

    <!-- Free Tour Section -->
    <section>
        <h2>Informations local</h2>
        <div>
            <h3>Lieu d'intérêt</h3>
            <ul>
                @foreach($placesOfInterest as $place)
                    <li>{{ $place->name }} - {{ $place->description }}</li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3>Evénement à venir</h3>
            <ul>
                @foreach($events as $event)
                    <li>{{ $event->name }} - {{ $event->date }}</li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3>Horraire de transport</h3>
            <ul>
                @foreach($transportSchedules as $schedule)
                    <li>{{ $schedule->route }} - {{ $schedule->time }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Recherche d'information avec filtres -->
    <section>
        <h2>Chercher des informations</h2>
        <form method="GET" action="{{ route('search') }}">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="places">Lieu d'intérêt</option>
                <option value="events">Evénement</option>
                <option value="transport">Horraire de transport</option>
            </select>

            <label for="keyword">Mot-clé:</label>
            <input type="text" name="keyword" id="keyword">

            <button type="submit">rechercher</button>
        </form>
    </section>

    <!-- Inscription sur la plateforme -->
    <section>
        <h2>Rejoignez nous !</h2>
        <p>connecté vous pour plus de fonctionnalités</p>
        <a href="{{ route('register') }}">connexion</a>
    </section>

</body>
</html>
