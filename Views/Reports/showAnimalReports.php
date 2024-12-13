<p>Rapports pour <?= htmlspecialchars($animal->name ?? 'Animal inconnu') ?></p>

<?php if (!empty($reports)): ?>
    <ul>
        <?php foreach ($reports as $report): ?>
            <li>
                <strong>Date :</strong> <?= htmlspecialchars($report->date_report) ?><br>
                <strong>Détails :</strong> <?= htmlspecialchars($report->details) ?><br>
                <strong>État de santé :</strong> <?= htmlspecialchars($report->health_state) ?><br>
                <strong>Nourriture :</strong> <?= htmlspecialchars($report->food) ?><br>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun rapport vétérinaire disponible pour cet animal.</p>
<?php endif; ?>
