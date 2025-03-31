<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Ville de Croisée</title>
    <link rel="stylesheet" href="../css/ConnectéSimpleCSS.css">

    
</head>
<body>

    <header class="header-container">
        <div class="search-bar">
            <input type="text" placeholder="Recherche...">
        </div>

        <div class="profile-container">
            <h1>La Ville de Croisée</h1>
            <form method="GET" action="{{ route('register') }}">
            <a href="{{ route('register') }}">
                <img src="https://via.placeholder.com/50" alt="Photo de profil">
            </a>
        </div>
    </header>
    <nav>
        <button>ANNONCES</button>
        <button>DÉCOUVRIR</button>
        <button>TRANSPORT</button>
        <button>RESERVER</button>
    </nav>


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

    <!-- Recherche d'information avec filtres -->
    <section>
        <h2>Chercher des informations</h2>
        <form method="GET" action="{{ route('search') }}">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="places">Lieux d'intérêts</option>
                <option value="events">Evenement</option>
                <option value="transport">Horaires de transports</option>
            </select>

            <label for="keyword">Mot-clé:</label>
            <input type="text" name="keyword" id="keyword">

            <button type="submit">rechercher</button>
        </form>
    </section>

    <!-- Inscription sur la plateforme -->
    <section>
        <h2>Rejoignez nous !</h2>
        <p>Connectez vous pour plus de fonctionnalités</p>
        <a href="{{ route('register') }}">Connexion</a>
    </section>

</body>
</html>