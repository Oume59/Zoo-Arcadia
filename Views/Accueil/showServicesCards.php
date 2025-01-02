<?php
$css = "showServicesCards";
?>

<div class="container py-5">
    <h3 class="animate-title text-center"><?= htmlspecialchars($service->name); ?></h3>

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <img src="/assets/img/<?= htmlspecialchars($service->img); ?>"
                class="animate-img img-fluid rounded"
                alt="<?= htmlspecialchars($service->name); ?>">
        </div>
        <div class="col-md-6">
            <h3 class="animate-description">Description</h3> <br>
            <p class="animate-description"><?= nl2br(htmlspecialchars($service->description)); ?></p>
        </div>
    </div>
</div>

<!-- PARTIE JS pour l'animation -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const animatedElements = document.querySelectorAll('.animate-title, .animate-img, .animate-description');

        // Add la classe 'visible' avec un léger délai
        animatedElements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('visible');
            }, index * 300); // temps entre chaque élément (300ms)
        });
    });
</script>