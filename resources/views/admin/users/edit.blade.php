<?php abort_if(!auth()->user()->hasRole('administrateur'), 403); ?>

@extends('layouts.barreNav')

@section('content')
<div class="container">
    <h1>Modifier l'utilisateur</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
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

        <!-- Points -->
        <div class="mb-3">
            <label for="xp" class="form-label">Points accumulés</label>
            <input type="number" name="xp" id="xp" class="form-control" value="{{ old('xp', $user->xp) }}" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" id="role" class="form-select">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
