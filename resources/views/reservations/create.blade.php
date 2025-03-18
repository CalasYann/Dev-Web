{{-- resources/views/reservations/create.blade.php --}}

@extends('layouts.app')

@section('content')
    <h1>Réserver : {{ $place->name }}</h1>
    <form action="{{ route('reservations.store', $place->id) }}" method="POST">
        @csrf
        <label for="reservation_time">Heure de réservation :</label>
        <input type="datetime-local" name="reservation_time" id="reservation_time" required>
        <button type="submit">Réserver</button>
    </form>
@endsection
