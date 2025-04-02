@extends('layouts.barreNav')

@section('content')
<div class="container">
    <h1>Profil de {{ $user->name }}</h1>
    
    <p><strong>Nom :</strong> {{ $user->name }}</p>

    <p><strong>Role :</strong> {{ implode(', ', $user->getRoleNames()->toArray()) }}</p>
    <p><strong>Experience :</strong> {{ $user->xp }}</p>
    <p><strong>Date de création :</strong> {{ $user->created_at }}</p>

    @auth
        @if (session('message'))
            <p class="alert alert-info">{{ session('message') }}</p>
        @endif

        <p><strong>Email :</strong> {{ auth()->user()->email }}</p>

        @if (auth()->user()->email_verified_at)
            <p class="text-success">✅ E-mail vérifié</p>
        @else
            <p class="text-danger">❌ E-mail non vérifié</p>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-warning">Renvoyer l'e-mail de vérification</button>
            </form>
        @endif
        @if(auth()->user()->id === $user->id || auth()->user()->hasRole('administrateur'))
            <a href="{{ route('profile.edit', auth()->user()) }}" class="btn btn-primary">Modifier mon profil</a>

            @if(auth()->user()->hasRole('administrateur'))
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="btn btn-primary">👤 Module administrateur</a>
            </li>
            @endif

        @endif
    @endauth                
</div>
@endsection
