@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mon Profil</h1>
    <ul>
        <li><strong>Nom :</strong> {{ $user->name }}</li>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>XP :</strong> {{ $user->xp }}</li>
    </ul>

    <h2>Votre statut :</h2>
    @if($user->hasRole('simple'))
        <p>Vous êtes un utilisateur simple.</p>
    @elseif($user->hasRole('complexe'))
        <p>Félicitations, vous êtes Complexe !</p>
    @elseif($user->hasRole('administrateur'))
        <p>Vous êtes Administrateur !</p>
    @endif
</div>
@endsection
