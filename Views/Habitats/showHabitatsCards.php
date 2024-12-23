<?php
$css = "showHabitatsCards";
?>

<div class="container py-5">
    <h3 class="text-center"><?= htmlspecialchars($habitat->name); ?></h3>

    <div class="row">
        <div class="col-md-6">
            <img src="/assets/img/<?= htmlspecialchars($habitat->img); ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($habitat->name); ?>">
        </div>
        <div class="col-md-6">
            <h3>Description</h3>
            <p><?= nl2br(htmlspecialchars($habitat->description)); ?></p>
        </div>
    </div>
</div>
