{{-- resources/views/places/index.blade.php --}}
@extends('layouts.barreNav')

@section('content')
    <div>
        <div class="lieux">
            <h1>Chercher un lieu</h1>
            <form method="GET" action="{{ route('places.index') }}">
                @csrf

                <label for="type">Type :</label>
                <select name="type" id="type">
                    <option value="">Tous</option>
                    <option value="Sport" {{ request('type') == 'Sport' ? 'selected' : '' }}>Sport</option>
                    <option value="Culture" {{ request('type') == 'Culture' ? 'selected' : '' }}>Culture</option>
                    <option value="Loisir" {{ request('type') == 'Loisir' ? 'selected' : '' }}>Loisir</option>
                </select>

                <label for="affluence_min">Affluence minimale :</label>
                <input type="number" name="affluence_min" id="affluence_min" min="0" value="{{ request('affluence_min') }}">

                <label for="affluence_max">Affluence maximale :</label>
                <input type="number" name="affluence_max" id="affluence_max" min="0" value="{{ request('affluence_max') }}">

                <label for="horaire_ouverture">Ouvert après :</label>
                <input type="time" name="horaire_ouverture" id="horaire_ouverture" value="{{ request('horaire_ouverture') }}">

                <label for="horaire_fermeture">Ferme après :</label>
                <input type="time" name="horaire_fermeture" id="horaire_fermeture" value="{{ request('horaire_fermeture') }}">

                <button type="submit">Filtrer</button>
            </form>
        </div>
        <!-- Affiche la liste des lieux -->
         <div class="liste-lieux">
            <ul>
                @foreach ($places as $place)
                    <div class="lieu-box">
                        <h3>{{ $place->name }} ({{ $place->type }})</h3>
                        <p>{{ $place->description }}</p>
                        <p>Affluence : {{ $place->affluence }}</p>
                        <p>Ouverture : {{ $place->horaire_ouverture }}</p>
                        <p>Fermeture : {{ $place->horaire_fermeture }}</p>

                        <!-- Bouton Modifier -->
                        <a href="{{ route('places.edit', $place) }}" class="btn btn-warning">Modifier</a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('places.destroy', $place) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce lieu ?')">Supprimer</button>
                        </form>
                        
                        <a href="{{ route('reservations.create', $place) }}" class="btn btn-primary">Réserver</a>

                    </div>
                @endforeach
            </ul>
        </div>
    <!-- Afficher mes réservations à venir -->
        
    </div>

@endsection
