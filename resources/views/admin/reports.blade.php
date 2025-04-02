<?php abort_if(!auth()->user()->hasRole('administrateur'), 403); ?>
@extends('layouts.barreNav')

@section('content')
<div class="container">
    <h1>Liste des signalements</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Utilisateur</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->title }}</td>
                <td>{{ $report->description }}</td>
                <td>{{ $report->user->name }}</td>
                <td>{{ $report->created_at }}</td>
                <td>
                    @if(auth()->user()->hasRole('administrateur'))
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Confirmez-vous la suppression de ce signalement ?');">
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
    {{ $reports->links() }}
</div>
@endsection
