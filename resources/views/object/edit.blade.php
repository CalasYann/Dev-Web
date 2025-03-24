@extends('layouts.app')

@section('content')
    <h1>Modifier {{ $device->name }}</h1>
    <form action="{{ route('object.update', $device->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom :</label>
        <input type="text" name="name" value="{{ $device->name }}" required>

        <label>Type :</label>
        <input type="text" name="type" value="{{ $device->type }}" required>

        <label>Statut :</label>
        <select name="status" required>
            <option value="online" {{ $device->status == 'online' ? 'selected' : '' }}>🟢 En ligne</option>
            <option value="offline" {{ $device->status == 'offline' ? 'selected' : '' }}>🔴 Hors ligne</option>
            <option value="maintenance" {{ $device->status == 'maintenance' ? 'selected' : '' }}>🛠 En maintenance</option>
        </select>

        <label>Emplacement :</label>
        <input type="text" name="location" value="{{ $device->location }}">

        <button type="submit">Mettre à jour</button>
    </form>
@endsection
