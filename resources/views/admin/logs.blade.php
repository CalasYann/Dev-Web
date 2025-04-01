       @extends('layouts.app')

@section('content')
<h1>Historique des actions</h1>
<table class="table">
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Action</th>
            <th>Page</th> <!-- Affichage de l'URL -->
            <th>Détails</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->user->name ?? 'N/A' }}</td>
            <td>{{ ucfirst($log->event) }}</td>
            <td>
                <a href="{{ $log->url }}" target="_blank">{{ $log->url }}</a>
            </td>
            <td>
                @if ($log->event === 'updated')
                    @foreach($log->getModified() as $attribute => $values)
                        <strong>{{ $attribute }}:</strong> {{ $values['old'] }} -> {{ $values['new'] }}<br>
                    @endforeach
                @else
                    <em>Aucune modification</em>
                @endif
            </td>
            <td>{{ $log->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $logs->links() }}


{{ $logs->links() }}
@endsection




{{--  
<table class="table">
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Action</th>
            <th>Détails</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->details }}</td>
            <td>{{ $log->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
--}}