<?php
$css = "showHabitatsCards";
?>

<div class="container py-5">
    <h3 class="text-center"><?= htmlspecialchars($habitat->name); ?></h3>

    <div class="row align-items-center">
        <div class="col-md-12 text-center">
            <img src="/assets/img/<?= htmlspecialchars($habitat->img); ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($habitat->name); ?>">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="report-container">
                <h4>Description :</h4>
                <p><?= nl2br(htmlspecialchars($habitat->description)); ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="report-container">
                <h4>Commentaire Vétérinaire :</h4>
                <p><?= !empty($habitat->commentaire) ? htmlspecialchars($habitat->commentaire) : 'Aucun commentaire disponible.'; ?></p>
            </div>
        </div>
    </div>

    <h3 class="text-center">Animaux dans cet habitat</h3>
    <div class="row">
        <?php if (!empty($animals)): ?>
            <?php foreach ($animals as $animal): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img src="/assets/img/<?= htmlspecialchars($animal->img); ?>" class="card-img-top" alt="<?= htmlspecialchars($animal->name); ?>">
                        <div class="card-body text-center">
                            <p class="card-title"><?= htmlspecialchars($animal->name); ?></p>
                            <p class="card-text">Espèce : <?= htmlspecialchars($animal->species_name ?? 'Inconnue'); ?></p>
                            <a href="/DashReports/showAnimalReports/<?= htmlspecialchars($animal->id); ?>" class="btn btn-primary">Voir le rapport vétérinaire</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Aucun animal trouvé dans cet habitat.</p>
        <?php endif; ?>
    </div>
</div>

<!-- BUTTON RETURN -->
<div class="centered">
    <a href="/Habitats" class="btn-back">QUITTER</a>
</div>