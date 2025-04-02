@extends('layouts.barreNav')

@section('content')
<div class="show">
    <h1>Profil de {{ $user->prenom }} {{ $user->name }}</h1>

    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Adresse :</strong> {{ $user->adresse }}</p>
    <p><strong>Âge :</strong> {{ $user->age }} ans</p>
    <p><strong>Métier :</strong> {{ $user->metier }}</p>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour à la recherche</a>
</div>
@endsection
