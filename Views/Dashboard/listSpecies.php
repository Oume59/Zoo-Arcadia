<?php
$css = "listDashboard";
?>

<h3>Liste des Espèces</h3>

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
                    <a href="/DashSpecies/edit/<?php echo $item->id; ?>">Éditer l'espèce</a> |
                    <a href="/DashSpecies/delete/<?php echo $item->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette espèce ?');">Supprimer</a>
                </td>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- BUTTON RETURN -->
<div class="centered">
<a href="/Dashboard" class="btn-back">QUITTER</a>
</div>