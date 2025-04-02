@extends('layouts.barreNav')

@section('content')

<style>
    body {
        background-image: url('/images/background3.jpg'); /* Image spécifique pour cette vue */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 80vh;
    }
</style>

    <div class="modifier-event">
        <h1>Modifier l'événement</h1>
        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nom :</label>
            <input type="text" name="nom" value="{{ $event->nom }}" required>

            <label>Date :</label>
            <input type="date" name="date" value="{{ $event->date }}" required>

            <label>Adresse :</label>
            <input type="text" name="adresse" value="{{ $event->adresse }}" required>

            <label>Description :</label>
            <textarea name="description" required>{{ $event->description }}</textarea>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
@endsection
