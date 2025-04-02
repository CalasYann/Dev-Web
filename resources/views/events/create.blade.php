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
    <div class="cree-evenements">
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
    </div>
@endsection
