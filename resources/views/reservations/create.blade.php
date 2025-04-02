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
<div class="reserver-lieu">
    <h2>Réserver {{ $place->name }}</h2>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('reservations.store', $place) }}" method="POST">
        @csrf

        <label for="start_time">Heure de début :</label>
        <input type="datetime-local" name="start_time" required>

        <label for="end_time">Heure de fin :</label>
        <input type="datetime-local" name="end_time" required>

        <button type="submit">Réserver</button>
    </form>
</div>
@endsection