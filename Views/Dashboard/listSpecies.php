<?php
$css = "listDashboard";
?>

<h3 class="text-center fw-bold">Liste des Espèces</h3>

<div class="table-wrapper">
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
                <td><?= htmlspecialchars($item->species); ?></td>
                <td>
                    <a href="/DashSpecies/edit/<?= $item->id; ?>">Éditer l'espèce</a> |
                    <a href="/DashSpecies/delete/<?= $item->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette espèce ?');">Supprimer</a>
                </td>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Messages de succès ou d'erreur -->
<?php if (isset($_SESSION['success_message'])): ?>
    <p style="color: green;"><?= $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <p style="color: red;"><?= $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<!-- BUTTON RETURN -->
<div class="centered">
<a href="/Dashboard" class="btn-back">QUITTER</a>
</div>
</div>