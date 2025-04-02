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

    <div class="evenements">
        <h1>Liste des événements</h1>
        @if(auth()->user()->hasRole('complexe') || auth()->user()->hasRole('administrateur'))
        <div class="button crée event">
            <a href="{{ route('events.create') }}">Créer un nouvel événement</a>
        </div>
        @endif
        @foreach ($events as $event)
            <div class="event">
                <h2>{{ $event->nom }}</h2>
                <p>Date : {{ $event->date }}</p>
                <p>Adresse : {{ $event->adresse }}</p>
                <p>Description : {{ $event->description }}</p>
                
                @if(auth()->user()->hasRole('administrateur'))
                <a href="{{ route('events.edit', $event->id) }}">Modifier</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
                @endif
            </div>
    @endforeach
    </div>
@endsection
