@extends('layouts.barreNav')

@section('content')
<div class="container">
    <h1>Profil de {{ $user->name }}</h1>
    
    <p><strong>Nom :</strong> {{ $user->name }}</p>

    <p><strong>Role :</strong> {{ implode(', ', $user->getRoleNames()->toArray()) }}</p>
    <p><strong>Experience :</strong> {{ $user->xp }}</p>
    <p><strong>Date de création :</strong> {{ $user->created_at }}</p>

    @auth
        @if(auth()->user()->id === $user->id || auth()->user()->hasRole('administrateur'))
            <a href="{{ route('profile.edit', $user) }}" class="btn btn-primary">Modifier mon profil</a>

            @if(auth()->user()->hasRole('administrateur'))
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">⚙️ Module Administrateur</a>
            </li>
            @endif

        @endif
    @endauth
</div>
@endsection
