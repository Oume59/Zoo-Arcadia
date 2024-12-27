<?php
$css = "showHabitatsCards";
?>

<div class="container py-5">
    <h3 class="text-center"><?= htmlspecialchars($habitat->name); ?></h3>

    <div class="row mb-4">
        <div class="col-md-6">
            <img src="/assets/img/<?= htmlspecialchars($habitat->img); ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($habitat->name); ?>">
        </div>
        <div class="col-md-6">
            <h3>Description</h3>
            <p><?= nl2br(htmlspecialchars($habitat->description)); ?></p>
            <br>
            <h3>Commentaire Vétérinaire :</h3>
<p><?= !empty($habitat->commentaire) ? htmlspecialchars($habitat->commentaire) : 'Aucun commentaire disponible.'; ?></p>
<br>
        </div>
    </div>

    <h3 class="text-center">Animaux dans cet habitat</h3>
    <div class="row">
        <?php if (!empty($animals)): ?>
            <?php foreach ($animals as $animal): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="/assets/img/<?= htmlspecialchars($animal->img); ?>" class="card-img-top" alt="<?= htmlspecialchars($animal->name); ?>">
                        <div class="card-body text-center">
                            <p class="card-title"><?= htmlspecialchars($animal->name); ?></p>
                            <p class="card-text">Espèce : <?= htmlspecialchars($animal->species_name ?? 'Inconnue'); ?></p>
                            <a href="/Reports/showAnimalReports/<?= htmlspecialchars($animal->id); ?>" class="btn btn-primary">Voir le rapport vétérinaire</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Aucun animal trouvé dans cet habitat.</p>
        <?php endif; ?>
    </div>
</div>