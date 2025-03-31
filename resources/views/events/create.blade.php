@extends('layouts.barreNav')

@section('content')
    <h1>Créer un événement</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Date :</label>
        <input type="date" name="date" required>

        <label>Adresse :</label>
        <input type="text" name="adresse" required>

        <label>Description :</label>
        <textarea name="description" required></textarea>

        <button type="submit">Créer</button>
    </form>
@endsection
