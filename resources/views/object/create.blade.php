@extends('layouts.app')

@section('content')
    <h1>Ajouter un Objet Connecté</h1>
    <form action="{{ route('object.store') }}" method="POST">
        @csrf

        <label>Nom :</label>
        <input type="text" name="name" required>

        <label>Type :</label>
        <input type="text" name="type" required>

        <label>Statut :</label>
        <select name="status" required>
            <option value="online">🟢 En ligne</option>
            <option value="offline">🔴 Hors ligne</option>
            <option value="maintenance">🛠 En maintenance</option>
        </select>

        <label>Emplacement :</label>
        <input type="text" name="location">


        <button type="submit">Ajouter</button>
    </form>
@endsection
