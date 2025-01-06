<?php
$css = "showAnimalReports";
?>

<div class="centered">
    <h3 class="report-title highlighted">Détails pour : <?= htmlspecialchars($animal->name ?? 'Animal inconnu') ?></h3>
</div>

<div class="centered">
    <h4>Rapports Vétérinaire</h4>
</div>

<?php if (!empty($reports)): ?>
    <div class="report-container">
        <ul class="report-list">
            <?php foreach ($reports as $report): ?>
                <li class="report-item">
                    <strong>Date :</strong> <?= htmlspecialchars($report->date_report ?? 'Non spécifié') ?><br>
                    <strong>Détails :</strong> <?= htmlspecialchars($report->details ?? 'Non spécifié') ?><br>
                    <strong>État de santé :</strong> <?= htmlspecialchars($report->health_state ?? 'Non spécifié') ?><br>
                    <strong>Nourriture recommandée :</strong> <?= htmlspecialchars($report->food ?? 'Non spécifié') ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p class="no-report">Aucun rapport vétérinaire disponible pour cet animal.</p>
<?php endif; ?>

<div class="centered">
    <h4>Consommations Alimentaires</h4>
</div>

<?php if (!empty($foodConsumptions)): ?>
    <div class="consumption-container">
        <ul class="consumption-list">
            <?php foreach ($foodConsumptions as $consumption): ?>
                <li class="consumption-item">
                    <strong>Date :</strong> <?= htmlspecialchars($consumption['date'] ?? 'Non spécifiée') ?><br>
                    <strong>Heure :</strong> <?= htmlspecialchars($consumption['time'] ?? 'Non spécifiée') ?><br>
                    <strong>Description :</strong> <?= htmlspecialchars($consumption['food'] ?? 'Non spécifiée') ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p class="no-consumption">Aucune consommation alimentaire enregistrée pour cet animal.</p>
<?php endif; ?>
