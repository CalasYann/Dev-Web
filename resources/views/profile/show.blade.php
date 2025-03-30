@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profil de {{ $user->name }}</h1>
    
    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Role :</strong> {{ implode(', ', $user->getRoleNames()->toArray()) }}</p>
    <p><strong>Experience :</strong> {{ $user->xp }}</p>
    <p><strong>Date de création :</strong> {{ $user->created_at }}</p>

    @auth
        @if(auth()->user()->id === $user->id || auth()->user()->hasRole('admin'))
            <a href="{{ route('profile.edit', $user) }}" class="btn btn-primary">Modifier mon profil</a>
            <a href="{{ route('admin.users') }}" class="btn btn-primary">Voir tous les utilisateurs</a>
            <a href="{{ route('makeAdmin') }}" class="btn btn-danger">Devenir Administrateur</a>

        @endif
    @endauth
</div>
@endsection
