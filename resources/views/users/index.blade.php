@extends('layouts.barreNav')

@section('content')
<div class="container">
    <h1>Rechercher des utilisateurs</h1>

    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
        <div class="row">
            <div class="col">
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="{{ request('prenom') }}">
            </div>
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Nom" value="{{ request('name') }}">
            </div>
            <div class="col">
                <input type="text" name="adresse" class="form-control" placeholder="Adresse" value="{{ request('adresse') }}">
            </div>
            <div class="col">
                <input type="number" name="age" class="form-control" placeholder="Âge" value="{{ request('age') }}">
            </div>
            <div class="col">
                <input type="text" name="metier" class="form-control" placeholder="Métier" value="{{ request('metier') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Réinitialiser</a>
            </div>
        </div>
    </form>

    <h2>Résultats :</h2>
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                <strong>{{ $user->prenom }} {{ $user->name }}</strong> - {{ $user->metier }}
                <br>📍 {{ $user->adresse }} | 🎂 {{ $user->age }} ans
                <br>
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Voir Profil</a>
            </li>
        @endforeach
    </ul>


    {{ $users->links() }}
</div>
@endsection
