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
    <div class="report-container"> <!-- Même classe que rapports vétérinaires -->
        <ul class="report-list"> <!-- Même liste -->
            <li class="report-item"> <!-- Même élément -->
                <strong>Date :</strong> <?= $reports->daily_food_date ?><br>
                <strong>Heure :</strong> <?= $reports->daily_food_time ?><br>
                <strong>Description :</strong> <?= $reports->daily_food ?><br>
            </li>
        </ul>
    </div>
<?php else: ?>
    <p class="no-consumption">Aucune consommation alimentaire enregistrée pour cet animal.</p>
<?php endif; ?>

<!-- BUTTON RETURN -->
<div class="centered">
    <button class="btn-back" onclick="window.history.back()">QUITTER</button>
</div>