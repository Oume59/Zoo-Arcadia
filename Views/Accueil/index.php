<?php
$css = "accueil"; // CSS Specifique 
?>

<img class="imgaccueil" src="/assets/img/tigreaccueil.jpg" alt="" />

<div class="title d-flex justify-content-center">
    <h1>PLONGEZ AU COEUR DE LA NATURE SAUVAGE</h1>
</div>

<!-- PARTIE SERVICES -->
<section id="description-zoo" class="text-center py-5">
    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center">
        <p>
            Arcadia, fondé en 1960 près de la forêt de
            Brocéliande, en Bretagne,<br> est un zoo qui incarne des valeurs écologiques fortes.<br>
            Totalement autonome en énergie grâce aux sources renouvelables,<br> il s'engage à protéger la biodiversité<br>
            tout en offrant une expérience immersive.<br> Réparti en trois habitats — Savane, Jungle, et Marais —,<br>
            le zoo accueille une grande diversité d'animaux,<br>
            tous surveillés par des vétérinaires pour garantir leur bien-être.<br>
            Le parc propose plusieurs services écoresponsables <br> afin d'améliorer l'expérience des visiteurs,<br>
            tout en sensibilisant à l'importance de l'écologie,<br>
            dont une visite en petit train, des restaurants, et une visite guidée gratuite,<br> pour offrir aux visiteurs
            une immersion totale dans la nature.
        </p>
    </div>
</section>

<!-- TITLE -->
<div class="title d-flex justify-content-center">
    <h2>NOS SERVICES</h2>
</div>

<!-- CARDS SERVICES -->
<section id="cards-services" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($services as $service): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card position-relative">
                        <img src="/assets/img/<?= htmlspecialchars($service->img) ?>"
                            class="card-img-top"
                            alt="<?= htmlspecialchars($service->name) ?>">
                        <div class="card-title-overlay">
                            <p><?= htmlspecialchars($service->name) ?></p>
                        </div>
                        <a href="/Main/showServicesCards/<?= htmlspecialchars($service->id) ?>"
                            class="btn btn-infos">INFOS</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- REVIEWS -->
<div class="title d-flex justify-content-center">
    <h3>LES AVIS</h3>
</div>