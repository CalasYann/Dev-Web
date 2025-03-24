@extends('layouts.app')

@section('content')
    <h1>Objets Connectés</h1>
    <a href="{{ route('object.create') }}">➕ Ajouter un objet</a>

    @foreach ($devices as $device)
        <div>
            <h3>{{ $device->name }} ({{ $device->type }})</h3>
            <p>
                Statut :
                @if ($device->status == 'online')
                    <span style="color: green;">🟢 En ligne</span>
                @elseif ($device->status == 'offline')
                    <span style="color: red;">🔴 Hors ligne</span>
                @else
                    <span style="color: orange;">🛠 En maintenance</span>
                @endif
            </p>
            <p>Emplacement : {{ $device->location ?? 'Non spécifié' }}</p>

            <a href="{{ route('object.edit', $device->id) }}">✏️ Modifier</a>
            <form action="{{ route('object.destroy', $device->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Supprimer cet objet ?')">🗑️ Supprimer</button>
            </form>
        </div>
    @endforeach
@endsection
