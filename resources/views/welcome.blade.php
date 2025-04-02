@extends('layouts.barreNav')

@section('content')
<style>
    body {
        background-image: url('/images/background.jpg'); /* Image spécifique pour cette vue */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 80vh;
    }
</style>

<main>

    <section class="events">
        <h3>Les événements à venir !</h3>
        @if($events->isEmpty())
            <p>Aucun événement prévu pour le moment.</p>
        @else
            <ul>
                @foreach($events as $event)
                    <li>
                        <strong>{{ \Carbon\Carbon::parse($event->date)->translatedFormat('l d F Y') }}</strong> 
                        - {{ $event->nom }} à {{ $event->adresse }}
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <section class="info">
        
        <div>
            <h3>Signaler un problème dans la ville en quelques clics !</h3>
            <p>Vous avez repéré un problème dans l'espace public ? Croisée met à votre disposition un service en ligne pour signaler facilement tout incident ou anomalie : voirie dégradée, éclairage défectueux, déchets abandonnés, ou tout autre souci impactant la vie quotidienne.</p>
            <a href="{{ route('report.index') }}">Signaler un problème</a>
        </div>
    </section>
        
        
    
</main>

    
{{-- 
    <section>
        <h2>si jamais vous avez un problème:</h2>
        <a href="{{ route('report.index') }}">Signaler un problème</a>

    </section> 
    <nav>
        <ul>
            <!-- Vérifie si l'utilisateur est connecté -->
            @if (auth()->check())
                <li><a href="{{ route('profile.show', auth()->user()) }}">Mon profil</a></li>
            @else
                <li><a href="{{ route('login') }}">Se connecter</a></li>
                <li><a href="{{ route('register') }}">S'inscrire</a></li>
            @endif
        </ul>
    </nav>
    --}} 

</body>
</html>
@endsection