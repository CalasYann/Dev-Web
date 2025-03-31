@extends('layouts.app')

@section('content')
<div class="container">
    <h1>⚙️ Module Administrateur</h1>

    <a href="{{ route('admin.users') }}" class="btn btn-primary">Voir tous les utilisateurs</a>
</div>
@endsection
