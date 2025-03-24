@extends('layouts.app')

@section('content')
    <h1>Modifier {{ $object_co->name }}</h1>
    <form action="{{ route('object_co.update', $object_co->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom :</label>
        <input type="text" name="name" value="{{ $object_co->name }}" required>

        <label>Type :</label>
        <input type="text" name="type" value="{{ $object_co->type }}" required>

        <label>Statut :</label>
        <select name="status" required>
            <option value="online" {{ $object_co->status == 'online' ? 'selected' : '' }}>🟢 En ligne</option>
            <option value="offline" {{ $object_co->status == 'offline' ? 'selected' : '' }}>🔴 Hors ligne</option>
            <option value="maintenance" {{ $object_co->status == 'maintenance' ? 'selected' : '' }}>🛠 En maintenance</option>
        </select>

        <label>Emplacement :</label>
        <input type="text" name="location" value="{{ $object_co->location }}">

        <button type="submit">Mettre à jour</button>
    </form>
@endsection
