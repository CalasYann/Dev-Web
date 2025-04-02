<?php abort_if(!auth(), 403); ?>
@extends('layouts.app')

@section('content')
    <h1>Réinitialisation du mot de passe</h1>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        
        <label>Email :</label>
        <input type="email" name="email" required>

        <label>Nouveau mot de passe :</label>
        <input type="password" name="password" required>

        <label>Confirmer le mot de passe :</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Réinitialiser le mot de passe</button>
    </form>
@endsection
