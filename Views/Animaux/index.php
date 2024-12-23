<?php
$css = "animaux";
?>

<!-- CAROUSEL -->
<section id="carousel-animals" class="py-4">
    <div id="carouselAnimaux" class="carousel slide mx-auto custom-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/assets/img/animvisiteurs.jpg" class="d-block w-100" alt="Image de visiteurs et animaux">
            </div>
            <div class="carousel-item">
                <img src="/assets/img/flamantmarais.jpg" class="d-block w-100" alt="Image de flamants roses">
            </div>
            <div class="carousel-item">
                <img src="/assets/img/elephantsavane.jpg" class="d-block w-100" alt="Image d'éléphants">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAnimaux" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselAnimaux" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- TITLE -->
<div class="title d-flex justify-content-center">
    <h2>DÉCOUVREZ NOS ESPÈCES FASCINANTES</h2>
</div>

<!-- DESCRIPTION ANIMALS -->
<section id="description-animals" class="text-center py-5">
    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center">
        <p>
            Chaque habitat est peuplé d'animaux spécifiques à leur écosystème : <br>
            Venez observer les lions, véritables rois de la savane, ainsi que les girafes et leurs longs cous gracieux, ou encore les éléphants, symboles de force et de sagesse.
            Les tigres majestueux rôdent dans la jungle dense, tandis que des familles de singes agiles jouent dans les arbres. Vous y découvrirez également des oiseaux tropicaux colorés qui égayent cet environnement verdoyant.
            Les crocodiles, maîtres des eaux, veillent sur leur territoire, accompagnés d'hippopotames imposants et de tortues qui se prélassent au soleil.
            Pour chaque animal, vous trouverez des rapports vétérinaires détaillés concernant leur santé, leur alimentation quotidienne et les soins prodigués.
        </p>
    </div>
</section>

<!-- CARDS ANIMALS -->
<section id="cards-animals" class="py-5">
    <div class="container">
        <div class="row g-2">
            <?php foreach ($animaux as $animal): ?>
                <div class="col-md-6">
                    <div class="card">
                        <img src="/assets/img/<?= htmlspecialchars($animal->img) ?>" class="card-img-top" alt="<?= htmlspecialchars($animal->name) ?>">
                        <div class="card-body">
                            <p class="card-text">Prénom : <?= htmlspecialchars($animal->name) ?><br>
                                Espèce : <?= htmlspecialchars($animal->animal_species ?? 'Inconnue') ?><br>
                                Habitat : <?= htmlspecialchars($animal->habitat_name ?? 'Inconnu') ?><br>
                                État : <?= htmlspecialchars($animal->health_state) ?></p>
                            <a href="/Reports/showAnimalReports/<?= htmlspecialchars($animal->id) ?>" class="btn btn-primary">PLUS D'INFOS</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>