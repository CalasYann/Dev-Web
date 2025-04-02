@extends('layouts.barreNav')

@section('content')
    <div class="edit-profile">
        <h1>Modifier mon profil</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="metier" class="form-label">Metier</label>
                <input type="text" class="form-control" id="metier" name="metier" value="{{ old('metier', $user->metier) }}" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $user->age) }}" required>
            </div>
            <p><strong>Role :</strong> {{ $user->role }}</p>
            <p><strong>Experience :</strong> {{ $user->xp }}</p>
            <p><strong>Date de création :</strong> {{ $user->created_at }}</p>


            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>

@endsection
