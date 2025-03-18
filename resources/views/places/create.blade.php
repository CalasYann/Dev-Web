{{-- resources/views/places/create.blade.php --}}
<h1>Créer un nouveau lieu</h1>
<form action="{{ route('places.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom du lieu :</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <button type="submit">Ajouter le lieu</button>
    </div>
</form>
