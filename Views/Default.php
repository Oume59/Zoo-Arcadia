<!-- redirection de page de mon Head, header nav bar, et mettre une balise du Main php avec le $contenu et footer -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="welcome" content="Bienvenue au Zoo Arcadia">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/Public/assets/css/accueil.css">
    <link rel="stylesheet" href="/Public/assets/css/defaultNavBar.css">
    <link rel="stylesheet" href="/Public/assets/css/defaultFooter.css">
    <title>ZOO ARCADIA</title>
</head>

<body>
    <header>
        <section header-container>
            <!--START LOGO ET NAV BARRE-->
            <nav class="navbar navbar-expand-lg bg-transparent">
                <img src="/assets/img/logozoo1.jpg" alt="Logo du zoo">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto">
                            <a class="nav-link active" aria-current="page" href="#liennavbar">Accueil & Services</a>
                            <a class="nav-link" href="#liennavdes">Habitats</a>
                            <a class="nav-link" href="#liennavlast">Animaux</a>
                            <a class="nav-link" href="#liennavlast">Contact</a>
                            <a href="/User" class="user-login"><i class="fa-solid fa-user"></i></a> <!-- lien vers la connexion utilisateur -->
                        </div>
                    </div>
                </div>
            </nav>
            <!--END LOGO ET NAV BARRE-->
        </section>
    </header>

    <main>
        <!-- CONTENU PRINCIPAL DES VUES PASSÉ PAR LE CONTROLLER (je m'assure avec la condition que la variable $contenu existe ou est bien définie pour fournir un message alternatif si KO) -->
        <?php if (isset($contenu)) : ?>
            <?= $contenu; ?>
        <?php else : ?>
            <p>Auncun contenu disponible.</p>
        <?php endif; ?>
    </main>


    <footer>
        <!-- PIED DE PAGE -->

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>