<?php
$css = "showAnimalReports";
?>

<div class="centered">
<h3 class="report-title highlighted">Détails pour : <?= htmlspecialchars($animal->name ?? 'Animal inconnu') ?></h3>
</div>

<!-- REPORTS VETERINRY -->
<div class="centered">
    <h4>Rapports Vétérinaires</h4>
</div>

<?php if (!empty($reports)): ?>
    <div class="report-container">
        <ul class="report-list">
                <li class="report-item">
                    <strong>Date :</strong> <?= $reports->date_report ?><br>
                    <strong>Détails :</strong> <?= $reports->details ?><br>
                    <strong>État de santé :</strong> <?= $reports->health_state ?><br>
                    <strong>Nourriture recommandée :</strong> <?= $reports->food ?><br>
                </li>
        </ul>
    </div>
<?php else: ?>
    <p class="no-report">Aucun rapport vétérinaire disponible pour cet animal.</p>
<?php endif; ?>

<!-- CONSO FOOD/J ANIMALS -->
<div class="centered">
    <h4>Consommations Alimentaires</h4>
</div>

<?php if (!empty($reports)): ?>
    <div class="consumption-container">
        <ul class="consumption-list">
                <li class="consumption-item">
                    <strong>Date :</strong> <?= $reports->daily_food_date ?>
                </li>
                <li class="consumption-item">
                    <strong>Heure :</strong> <?= $reports->daily_food_time ?>
                </li>
                <li class="consumption-item">
                    <strong>Description :</strong> <?= $reports->daily_food ?>
                </li>
        </ul>
    </div>
<?php else: ?>
    <p class="no-consumption">Aucune consommation alimentaire enregistrée pour cet animal.</p>
<?php endif; ?>
