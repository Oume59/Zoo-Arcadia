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

            <div class="col-md-5 mb-4">
                <div class="card">
                    <img src="/assets/img/couvsavane.jpg" class="card-img-top" alt="Savane">
                    <div class="card-body text-center">
                    <a href="/Habitats/showHabitatsCards/1" class="btn btn-primary">SAVANE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mb-4">
                <div class="card">
                    <img src="/assets/img/croco.jpg" class="card-img-top" alt="Marais">
                    <div class="card-body text-center">
                    <a href="/Habitats/showHabitatsCards/3" class="btn btn-primary">MARAIS</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5 mb-4">
                <div class="card">
                    <img src="/assets/img/couvjungle.jpg" class="card-img-top" alt="Jungle">
                    <div class="card-body text-center">
                    <a href="/Habitats/showHabitatsCards/2" class="btn btn-primary">JUNGLE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>