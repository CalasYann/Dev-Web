@extends('layouts.barreNav')

@section('content')
<main>
    <section class="highlight">
        <div class="text">
            <h2>Ne manquez pas le marché Hebdomadaire de Croisée chaque mercredi !</h2>
            <p>Venez découvrir les saveurs et les talents locaux ! Chaque mercredi, la ville de Croisée vous invite à son marché hebdomadaire...</p>
            <img src="https://www.uzes-pontdugard.com/app/uploads/iris-images/4667/marche-uzes-a-dpupg-aurelio-rodriguez-31-12-2030-45-1920x1080-f50_50.webp"/>
        </div>
    </section>

    <section class="info">
        <div>
            <h3>Patinoire, Salle de fête,etc...Comment les réserver ?</h3>
            <p>Vous préparez un anniversaire, une réception, un événement associatif ou une sortie entre amis ? Croisée met à votre disposition des infrastructures modernes et confortables pour organiser vos activités en toute simplicité.</p>
                
        </div>
        <div>
            <h3>Participez au Salon de l'Ingénieur de Croisée !</h3>
            <p>Croisée accueille cette année le Salon de l'Ingénieur, un événement incontournable pour les professionnels, les étudiants et les passionnés des sciences et technologies. Venez découvrir les dernières innovations, rencontrer des experts du secteur et explorer de nouvelles opportunités professionnelles.</p>
        </div>
        <div>
            <h3>Signaler un problème dans la ville en quelques clics !</h3>
            <p>Vous avez repéré un problème dans l'espace public ? Croisée met à votre disposition un service en ligne pour signaler facilement tout incident ou anomalie : voirie dégradée, éclairage défectueux, déchets abandonnés, ou tout autre souci impactant la vie quotidienne.</p>
            <a href="{{ route('report.index') }}">Signaler un problème</a>
        </div>

    <section class="events">
        <h3>Les événements à venir !</h3>
        <ul>
            <li><strong>Mardi 25 mars</strong> - Concert du conservatoire de Croisée</li>
            <li><strong>Mercredi 26 mars</strong> - Marché de Croisée au Square du Port</li>
        </ul>
    </section>
</main>

    

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
    

</body>
</html>
