<link rel="stylesheet" href="/assets/css/listDashboard.css">

<p>Liste des Espèces</p>

<table class="table-custom">
    <thead>
        <tr>
            <th>Nom de l'espèce</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($species as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item->species); ?></td>
                <td>
                    <a href="/ListSpecies/edit/<?php echo $item->id; ?>">Éditer l'espèce</a> |
                    <a href="/ListSpecies/delete/<?php echo $item->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette espèce ?');">Supprimer</a>
                </td>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>