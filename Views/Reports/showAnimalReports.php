<?php
$css = "showAnimalReports";
?>

<div class="centered">
    <h3 class="report-title highlighted">Détails pour : <?= htmlspecialchars($animal->name ?? 'Animal inconnu') ?></h3>
</div>

<!-- REPORTS VETERINARY -->
<div class="centered">
    <h4>Rapports Vétérinaires</h4>
</div>

<?php if (!empty($reports)): ?>
    <div class="report-container">
        <ul class="report-list">
            <?php foreach ($reports as $report): ?>
                <li class="report-item">
                    <strong>Date :</strong> <?= htmlspecialchars($report->date_report) ?><br>
                    <strong>Détails :</strong> <?= htmlspecialchars($report->details) ?><br>
                    <strong>État de santé :</strong> <?= htmlspecialchars($report->health_state) ?><br>
                    <strong>Nourriture recommandée :</strong> <?= htmlspecialchars($report->food) ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p class="no-report">Aucun rapport vétérinaire disponible pour cet animal.</p>
<?php endif; ?>

<!-- CONSO FOOD/J ANIMALS -->
<div class="centered">
    <h4>Consommations Alimentaires</h4>
</div>

<?php if (!empty($foodConsumptions)): ?>
    <div class="consumption-container">
        <ul class="consumption-list">
            <?php foreach ($foodConsumptions as $consumption): ?>
                <li class="consumption-item">
                    <strong>Date :</strong> <?= htmlspecialchars($consumption->date) ?><br>
                    <strong>Heure :</strong> <?= htmlspecialchars($consumption->time) ?><br>
                    <strong>Nourriture :</strong> <?= htmlspecialchars($consumption->food) ?><br>
                    <strong>Quantité :</strong> <?= htmlspecialchars($consumption->quantity) ?> g<br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p class="no-consumption">Aucune consommation alimentaire enregistrée pour cet animal.</p>
<?php endif; ?>