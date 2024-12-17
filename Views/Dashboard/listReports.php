<link rel="stylesheet" href="/assets/css/listDashboard.css">

<p>Liste des Rapports Vétérinaires</p>

<table class="table-custom">
    <thead>
        <tr>
            <th>Date</th>
            <th>Détails</th>
            <th>État de Santé</th>
            <th>Nourriture</th>
            <th>Animal</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $report): ?>
            <tr>
                <td><?php echo htmlspecialchars($report->date_report); ?></td>
                <td><?php echo htmlspecialchars($report->details); ?></td>
                <td><?php echo htmlspecialchars($report->health_state); ?></td>
                <td><?php echo htmlspecialchars($report->food); ?></td>
                <td><?php echo htmlspecialchars($report->name); ?></td>
                <td>
                    <a href="/ListReports/edit/<?php echo $report->id; ?>">Éditer</a> |
                    <a href="/ListReports/delete/<?php echo $report->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
