{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations</title>
    <!-- Inclure des styles CSS ici -->
</head>
<body>

    <nav>
        <!-- Menu de navigation ici -->
        <a href="{{ route('places.index') }}">Lieux</a>
        @auth
            <a href="{{ route('reservations.create', 1) }}">Réserver un lieu</a> <!-- Exemple de lien vers une réservation -->
        @endauth
    </nav>

    <div class="container">
        @yield('content') <!-- Contenu spécifique à chaque vue -->
    </div>

</body>
</html>
