@extends('layouts.barreNav')

@section('content')
<style>
    body {
        background-image: url('/images/background3.jpg'); /* Image spécifique pour cette vue */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 80vh;
    }
</style>
<div class="reserver">
    @if(auth()->user()->hasRole('complexe') || auth()->user()->hasRole('administrateur'))
    <div class="boutton-reserver">
        <a class="nav-link" href="{{ route('places.index') }}">
            <h2>Réserver un Lieu</h2>
        </a>
    </div>
    @endif
    <div class="container">
        <h1 class="mb-4"> Mes Réservations </h1>

        @if ($res->isEmpty())
            <p>Aucune réservation à venir !! </p>
        @else 
            <table>
                <thead>
                    <tr>
                        <th>Lieu</th>
                        <th>Date</th>
                        <th>Heure de début</th>
                        <th>Heure de fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($res as $res)
                        <tr>   
                            <td>{{ $res->place->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($res->start_time)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($res->end_time)->format('H:i') }}</td>
                            <td>
                                <form action="{{ route('reservations.destroy', $res->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection