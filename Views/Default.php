<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bienvenue au Zoo Arcadia">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php if (isset($css)): ?>
        <link href="/assets/css/<?= $css ?>.css" rel="stylesheet">
    <?php endif; ?>
    <link rel="stylesheet" href="/assets/css/default.css">
    
    <title>ZOO ARCADIA</title>
</head>

<body>
    <header>
        <section class="container-fluid">
            <!-- START LOGO & NAV BAR -->
            <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="/assets/img/logozoo1.jpg" alt="Logo du zoo" class="logo-img">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
  data-bs-target="#navbarNavAltMarkup"
  aria-controls="navbarNavAltMarkup" aria-expanded="false"
  aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

                    <!-- LINKS NAV BAR & CONNEXION USERS -->
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Accueil & Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/Habitats">Habitats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/Animaux">Animaux</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">Contact</a>
                            </li> <!-- CONDITION POUR QUE LA DECONNEXION SOIT VISIBLE SEULEMENT POUR LES UTILISATEURS -->
                            <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['administrateur', 'veterinaire', 'employe'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/LoginUsers/deconnexion">Déconnexion</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="d-flex align-items-center ms-auto">
                            <a href="/LoginUsers" class="user-login me-3"><i class="fa-solid fa-user"></i></a>
                            <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['administrateur', 'veterinaire', 'employe'])): ?>
                                <a href="/Dashboard" class="admin-link">Dashboard</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </nav>
            <!-- END LOGO & NAV BAR -->
        </section>
    </header>

    <!--START MAIN CONTENT -->
    <main><?= $contenu ?></main>
    <!--END MAIN CONTENT -->

    <!-- FOOTER -->
    <div id="footer" class="footer-container">
        <div class="row">
            <div class="col-md-4">
                <p class="footer-text"><strong>Adresse :</strong><br>
                    Zoo Arcadia<br><br>
                    Rte de Brocéliande<br>
                    56430 Tréhorenteuc,<br>
                    Bretagne.
                </p>
            </div>
            <div class="col-md-4">
                <id class="Horaires"></id=>
                <p class="footer-text"><strong>Horaires :</strong><br>
                    Le zoo est ouvert tous les jours :<br>
                    de 9h00 à 19h00.<br>
                    Fermeture : <br>
                    le 01 mai.
                </p>
            </div>
            <div class="col-md-4">
                <p class="footer-text">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#mentionsLegalesModal"><strong>Mentions légales.</strong></a><br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#confidentialiteModal"><strong>Politique de confidentialité.</strong></a><br>
                    <strong><i class="fa-regular fa-copyright"></i> 2025 Copyright : Tous droits réservés<br> Mélissa Ould Youcef</strong>
                </p>
            </div>
        </div>
        <div class="social-icons">
            <a href="https://www.linkedin.com" class="linkedin"><i class="fab fa-linkedin"></i></a>
            <a href="https://www.facebook.com" class="facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com" class="instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com" class="twitter"><i class="fab fa-x-twitter"></i></a>
        </div>
    </div>

    <!-- MODALS -->
    <div class="modal fade" id="mentionsLegalesModal" tabindex="-1" aria-labelledby="mentionsLegalesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="mentionsLegalesModalLabel"><strong>Mentions légales</strong></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ce site est édité par : <strong>Mélissa Ould Youcef</strong></p>
                    <p>Siège social : Rte de Brocéliande, 56430 Tréhorenteuc, Bretagne</p>
                    <p>Email : joseoumearcadia@gmail.com</p>
                    <p>SIRET : 123 000 000 00000</p>
                    <p>Forme juridique : Société à responsabilité limitée (SARL)</p>
                    <p>Hébergeur : HEROKU, SANS FRANCISCO, Californie, USA</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confidentialiteModal" tabindex="-1" aria-labelledby="confidentialiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="confidentialiteModalLabel"><strong>Politique de confidentialité</strong></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Données collectées : Le site Zoo Arcadia collecte uniquement les données saisies dans les formulaires (nom et adresse e-mail) pour gérer les messages et les avis des utilisateurs.</p>
                    <p>Cookies utilisés : Aucun cookie de suivi ou traceur publicitaire n’est utilisé. Seuls les cookies de session nécessaires au bon fonctionnement du site sont créés automatiquement, puis supprimés à la fin de la navigation.</p>
                    <p>Droits : Conformément au RGPD, vous pouvez demander la consultation, la modification ou la suppression de vos données personnelles via le formulaire de contact.</p>
                    <p>Contact RGPD : Pour toute question liée à vos données personnelles, veuillez nous contacter via le formulaire de contact.</p>
                    <p>Hébergeur : HEROKU, SANS FRANCISCO, Californie, USA.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END FOOTER -->

    <!-- SCRIPTS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script defer src="/assets/js/modals.js"></script>

</body>

</html>