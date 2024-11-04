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
    <link rel="stylesheet" href="/assets/css/accueil.css">
    <link rel="stylesheet" href="/assets/css/defaultNavBar.css">
    <link rel="stylesheet" href="/assets/css/defaultFooter.css">
    <title>ZOO ARCADIA</title>
</head>

<body>
    <header>
        <section class="container-fluid">
            <!-- START LOGO ET NAV BAR -->
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

                    <!-- LiENS NAV BAR ET CONNEXION UTILISATEURS -->
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/accueil">Accueil & Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/habitats">Habitats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/animaux">Animaux</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/deconnexion">Déconnexion</a>
                            </li>
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
            <!-- END LOGO ET NAV BAR -->
        </section>
    </header>

    <!-- Main contenu -->
    <main><?= $contenu ?></main>

    <!-- Footer -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>