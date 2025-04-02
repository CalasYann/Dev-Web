@extends('layouts.barreNav')

@section('content')
    <h1>Rapport d'utilisation des objets connectés</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre d'interactions</th>
                <th>Consommation énergétique (kW)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objects as $object)
                <tr>
                    <td>{{ $object->name }}</td>
                    <td>{{ $object->nombre_interactions }}</td>
                    <td>{{ number_format($object->getConsommationTotaleAttribute(), 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('object_co.rapport.pdf') }}" class="btn btn-primary">Télécharger le PDF</a>
@endsection
