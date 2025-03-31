@extends('layouts.barreNav')

@section('content')
    <div class="container">
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
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            
            <p><strong>Role :</strong> {{ $user->role }}</p>
            <p><strong>Experience :</strong> {{ $user->xp }}</p>
            <p><strong>Date de création :</strong> {{ $user->created_at }}</p>


            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password">
                    <button type="button" class="btn btn-secondary" onclick="togglePassword()">👁️</button>
                </div>
                <small class="text-muted">Laissez vide pour ne pas changer le mot de passe.</small>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            let passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
@endsection
