<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>
<body>

    <header>
        <h1>Welcome to the Visitor's Free Tour</h1>
        <p>Explore local places, events, and transport schedules.</p>
    </header>

    <!-- Free Tour Section -->
    <section>
        <h2>Discover Local Information</h2>
        <div>
            <h3>Places of Interest</h3>
            <ul>
                @foreach($placesOfInterest as $place)
                    <li>{{ $place->name }} - {{ $place->description }}</li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3>Upcoming Events</h3>
            <ul>
                @foreach($events as $event)
                    <li>{{ $event->name }} - {{ $event->date }}</li>
                @endforeach
            </ul>
        </div>
        <div>
            <h3>Transport Schedules</h3>
            <ul>
                @foreach($transportSchedules as $schedule)
                    <li>{{ $schedule->route }} - {{ $schedule->time }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Recherche d'information avec filtres -->
    <section>
        <h2>Search Information</h2>
        <form method="GET" action="{{ route('search') }}">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="places">Places of Interest</option>
                <option value="events">Events</option>
                <option value="transport">Transport Schedules</option>
            </select>

            <label for="keyword">Keyword:</label>
            <input type="text" name="keyword" id="keyword">

            <button type="submit">Search</button>
        </form>
    </section>

    <!-- Inscription sur la plateforme -->
    <section>
        <h2>Join Us</h2>
        <p>Sign up to access more features!</p>
        <a href="{{ route('register') }}">Sign up</a>
    </section>

</body>
</html>
