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

    <link rel="stylesheet" href="/assets/css/defaultNavBar.css">
    <link rel="stylesheet" href="/assets/css/defaultFooter.css">
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
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
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
                                <a class="nav-link" href="/">Habitats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/animaux-visiteur">Animaux</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">Contact</a>
                            </li> <!-- CONDITION POUR QUE LA DECONNEXION SOIT VISIBLE SEULEMENT POUR LES UTILISATEURS -->
                            <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['administrateur', 'veterinaire', 'employe'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/deconnexion">Déconnexion</a>
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
    <div class="footer-container">
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
    <!-- END FOOTER -->

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
                    <p>Hébergeur : OVH, 2 Rue Kellermann, 59100 Roubaix, France</p>
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
                    <p>Données collectées : Le zoo Arcadia collecte des données personnelles telles que le nom et l’adresse e-mail via le formulaire de contact et les avis laissés sur le site.</p>
                    <p>Cookies utilisés : Nous utilisons des cookies analytiques, de session et fonctionnels pour améliorer l'expérience utilisateur et le suivi statistique.</p>
                    <p>Finalité : Les données sont utilisées uniquement pour la gestion des avis, des services demandés, et les statistiques de consultation des animaux.</p>
                    <p>Droits : Conformément au RGPD, vous avez le droit d'accéder, de modifier ou de supprimer vos données personnelles à tout moment.</p>
                    <p>Contact RGPD : Pour toute question liée à vos données personnelles, veuillez nous contacter via le formulaire de contact.</p>
                    <p>Hébergeur : OVH, 2 Rue Kellermann, 59100 Roubaix, France.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/js/modals.js"></script> <!-- Assurez-vous que le chemin est correct -->

</body>

</html>