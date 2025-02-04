<?php
$css = "accueil";
?>

<img class="imgaccueil" src="/assets/img/tigreaccueil.jpg" alt="" />

<div class="title d-flex justify-content-center">
    <h1>PLONGEZ AU COEUR DE LA NATURE SAUVAGE</h1>
</div>

<!-- SERVICES -->
<section id="description-zoo" class="text-center py-5">
    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center">
        <p>
            Arcadia, fondé en 1960 près de la forêt de
            Brocéliande, en Bretagne,<br> est un zoo qui incarne des valeurs écologiques fortes.<br>
            Totalement autonome en énergie grâce aux sources renouvelables,<br> il s'engage à protéger la biodiversité<br>
            tout en offrant une expérience immersive.<br> Réparti en trois habitats — Savane, Jungle, et Marais —,<br>
            le zoo accueille une grande diversité d'animaux,
            tous surveillés par des vétérinaires pour garantir leur bien-être.<br>
            Le parc propose plusieurs services écoresponsables <br> afin d'améliorer l'expérience des visiteurs,<br>
            tout en sensibilisant à l'importance de l'écologie,
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

<section id="avis">
    <div class="container py-4">

        <!-- CAROUSEL -->
        <div id="carouselAvis" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php if (empty($validatedReviews)): ?>
                    <div class="carousel-item active">
                        <div class="card custom-card">
                            <div class="card-body text-center">
                                <p>Aucun avis validé n'est disponible pour le moment.</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php $isActive = true; ?>
                    <?php foreach ($validatedReviews as $review): ?>
                        <div class="carousel-item <?= $isActive ? 'active' : ''; ?>">
                            <div class="card custom-card mx-auto">
                                <div class="card-body">
                                    <div class="card-title d-flex justify-content-between align-items-center">
                                        <span class="pseudo"><?= htmlspecialchars($review['pseudo']); ?></span>
                                        <div class="rating-display d-flex">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span class="star <?= $i <= $review['note'] ? 'filled' : ''; ?>">★</span>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="card-text mt-3">"<?= html_entity_decode($review['avis']); ?>"</p> <!-- sécurité dans le controller -->
                                    <p class="card-date text-end"><small>Publié le : <?= htmlspecialchars($review['date'] ?? 'Non spécifié'); ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php $isActive = false; ?>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselAvis" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselAvis" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </div>
</section>

<!-- ADD REVIEWS -->
<div class="text-center mt-4 mb-5">
    <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#modalAvis">POSTER</button>
</div>

<!-- MODAL REVIEWS -->
<div class="modal fade" id="modalAvis" tabindex="-1" aria-labelledby="modalAvisLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/Reviews/addReview" method="POST" id="formAvis">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                <div class="modal-header">
                    <div class="modal-title" id="modalAvisLabel"><strong>Poster un Avis :</strong></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo (requis pour soumettre votre avis) :</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="avis" class="form-label">Votre avis (requis pour soumettre votre avis) :</label>
                        <textarea class="form-control" id="avis" name="avis" rows="3" placeholder="Entrez votre avis ici" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Votre note (requis pour soumettre votre avis) :</label>
                        <div class="rating">
                            <input type="radio" id="star1" name="etoiles" value="1" required>
                            <label for="star1">★</label>
                            <input type="radio" id="star2" name="etoiles" value="2">
                            <label for="star2">★</label>
                            <input type="radio" id="star3" name="etoiles" value="3">
                            <label for="star3">★</label>
                            <input type="radio" id="star4" name="etoiles" value="4">
                            <label for="star4">★</label>
                            <input type="radio" id="star5" name="etoiles" value="5">
                            <label for="star5">★</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="/assets/js/modals.js"></script>
