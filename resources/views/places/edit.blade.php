<form method="POST" action="{{ route('places.update', $place) }}">
    @csrf
    @method('PUT')

    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" value="{{ $place->name }}" required>

    <label for="type">Type :</label>
    <select name="type" id="type" required>
        <option value="Sport" {{ $place->type == 'Sport' ? 'selected' : '' }}>Sport</option>
        <option value="Culture" {{ $place->type == 'Culture' ? 'selected' : '' }}>Culture</option>
        <option value="Loisir" {{ $place->type == 'Loisir' ? 'selected' : '' }}>Loisir</option>
    </select>

    <label for="description">Description :</label>
    <textarea name="description" id="description">{{ $place->description }}</textarea>

    <label for="affluence">Affluence :</label>
    <input type="number" name="affluence" id="affluence" value="{{ $place->affluence }}" min="0">

    <label for="horaire_ouverture">Heure d'ouverture :</label>
    <input type="time" name="horaire_ouverture" id="horaire_ouverture" value="{{ $place->horaire_ouverture }}" required>

    <label for="horaire_fermeture">Heure de fermeture :</label>
    <input type="time" name="horaire_fermeture" id="horaire_fermeture" value="{{ $place->horaire_fermeture }}" required>

    <button type="submit">Mettre à jour</button>
</form>
