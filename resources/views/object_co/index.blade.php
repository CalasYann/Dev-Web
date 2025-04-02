<!-- resources/views/object_co/index.blade.php -->
@extends('layouts.barreNav')

@section('content')
<div class="liste-obj">
    <h1>Liste des objets connectés</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    
</div>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Emplacement</th>
                <th>Consommation Totale (kW)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objects as $object)
                <tr>
                    <td>{{ $object->name }}</td>
                    <td>{{ $object->type }}</td>
                    <td>{{ $object->status }}</td>
                    <td>{{ $object->location }}</td>
                    <td>{{ $object->consommation_totale }}</td>

                    <td>
                        @if(auth()->user()->hasRole('complexe') || auth()->user()->hasRole('administrateur'))
                            <a href="{{ route('object_co.edit', $object->id) }}" class="btn btn-warning">Modifier</a>
                        @endif
                    
                        @if(auth()->user()->hasRole('administrateur'))
                            <form action="{{ route('object_co.destroy', $object->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet objet ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 
    <a href="{{ route('object_cos.rapport') }}" class="btn btn-primary">
        Voir le rapport des objets connectés
    </a>     --}}
@endsection