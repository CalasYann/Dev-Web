@if(!auth()->check() || !auth()->user()->hasRole('administrateur'))
    <script>window.location.href = "{{ url('/') }}";</script>
@endif

@extends('layouts.barreNav')

@section('content')
<div class="module-admin">
    <div class="titre">
        <h1>Liste des utilisateurs</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Modifier</a>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.logs') }}" class="btn btn-primary">
        Voir les logs
    </a>
    
    <form action="{{ route('backup') }}" method="POST">
        @csrf  <!-- Inclus un token CSRF pour la sécurité -->
        <button type="submit" class="btn btn-primary">Créer une sauvegarde</button>
    </form>
    
    <a href="{{ route('admin.reports') }}" class="btn btn-danger">📢 Voir les signalements</a>

    <a href="{{ route('object_cos.rapport') }}" class="btn btn-primary">
        Voir le rapport des objets connectés
    </a>  

    <a href="{{ route('admin.places') }}" class="btn btn-primary">
        Ajouter un nouveau lieu
    </a>  

    <a href="{{ route('object_co.create') }}" class="btn btn-primary">Ajouter un objet</a> 

   {{ $users->links() }} 
</div>
@endsection
