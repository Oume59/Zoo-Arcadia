<?php
$css = "listDashboard";
?>

<h3>Rapports Vétérinaires et Données Alimentaires</h3>

<table class="table-custom">
    <thead>
        <tr>
            <th>Date du Rapport</th>
            <th>Détails</th>
            <th>État de Santé</th>
            <th>Nourriture recommandée (Vétérinaire)</th>
            <th>Nourriture donnée sur la journée (Employé)</th>
            <th>Animal</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $report): ?>
            <tr>
                <td><?= htmlspecialchars($report->date_report); ?></td>
                <td><?= htmlspecialchars($report->details); ?></td>
                <td><?= htmlspecialchars($report->health_state); ?></td>
                <td><?= htmlspecialchars($report->food); ?></td>
                <td><?= !empty($report->daily_food) ? nl2br(htmlspecialchars($report->daily_food)) : 'Aucune donnée entrée'; ?></td>
                <td><?= htmlspecialchars($report->animal_name); ?></td>
                <td>
                    <a href="/DashReports/edit/<?= $report->id; ?>">Modifier</a>
                    <a href="/DashReports/delete/<?= $report->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- BUTTON RETURN -->
<div class="centered">
<a href="/Dashboard" class="btn-back">QUITTER</a>
</div>