<h2>Réserver {{ $place->name }}</h2>

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('reservations.store', $place) }}" method="POST">
    @csrf

    <label for="start_time">Heure de début :</label>
    <input type="datetime-local" name="start_time" required>

    <label for="end_time">Heure de fin :</label>
    <input type="datetime-local" name="end_time" required>

    <button type="submit">Réserver</button>
</form>

