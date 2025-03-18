{{-- resources/views/places/show.blade.php --}}

@extends('layouts.app')

@section('content')
    <h1>{{ $place->name }}</h1>
    <p>Type : {{ $place->type }}</p>
    <p>Capacité : {{ $place->capacity }}</p>
    <a href="{{ route('reservations.create', $place->id) }}">Réserver ce lieu</a>
@endsection
