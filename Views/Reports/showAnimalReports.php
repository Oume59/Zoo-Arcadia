<?php
$css = "showAnimalReports";
?>

<h3 class="report-title">Rapports pour <?= htmlspecialchars($animal->name ?? 'Animal inconnu') ?></h3>

<?php if (!empty($reports)): ?>
    <div class="report-container">
        <ul class="report-list">
            <?php foreach ($reports as $report): ?>
                <li class="report-item">
                    <strong>Date :</strong> <?= htmlspecialchars($report->date_report) ?><br>
                    <strong>Détails :</strong> <?= htmlspecialchars($report->details) ?><br>
                    <strong>État de santé :</strong> <?= htmlspecialchars($report->health_state) ?><br>
                    <strong>Nourriture :</strong> <?= htmlspecialchars($report->food) ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p class="no-report">Aucun rapport vétérinaire disponible pour cet animal.</p>
<?php endif; ?>