<?php
$css = "habitats";
?>

<!-- CAROUSEL -->
<section id="carousel-habitats" class="py-4">
    <div id="carouselHabitats" class="carousel slide mx-auto  custom-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/assets/img/savane.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item">
                <img src="/assets/img/chris-abney-qLW70Aoo8BE-unsplash.jpg" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item">
                <img src="/assets/img/tomasz-anusiewicz--7K0uzlKzpA-un.jpg" class="d-block w-100" alt="">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHabitats" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHabitats" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- TITLE -->
<div class="title d-flex justify-content-center">
    <h2>VOYAGE À TRAVERS LES HABITATS DU ZOO</h2>
</div>

<!-- CARDS HABITATS -->
<section id="cards-habitats" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($habitats as $habitat): ?>
                <div class="col-md-5 mb-4">
                    <div class="card">
                        <img src="/assets/img/<?= htmlspecialchars($habitat->img) ?>" class="card-img-top" alt="<?= htmlspecialchars($habitat->name) ?>">
                        <div class="card-body text-center">
                            <a href="/Habitats/showHabitatsCards/<?= htmlspecialchars($habitat->id) ?>" class="btn btn-primary">
                                <?= htmlspecialchars($habitat->name) ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>