@extends('layouts.app')

@section('content')
    <h1>Ajouter un objet connecté</h1>

    <form action="{{ route('object_co.store') }}" method="POST">
        @csrf

        <label>Nom :</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Type :</label>
        <input type="text" name="type" value="{{ old('type') }}" required>

        <label>Statut :</label>
        <select name="status" required>
            <option value="en marche" {{ old('status') == 'en marche' ? 'selected' : '' }}>En marche</option>
            <option value="éteint" {{ old('status') == 'éteint' ? 'selected' : '' }}>Éteint</option>
            <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>

        <label>Emplacement :</label>
        <input type="text" name="location" value="{{ old('location') }}">

        <button type="submit">Ajouter</button>
    </form>
@endsection
