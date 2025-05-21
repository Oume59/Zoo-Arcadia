<?php
$css = "listDashboard";
?>

<div class="table-wrapper">
<h3>Liste des Habitats</h3>

<table class="table-custom">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Commentaire Vétérinaire</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($habitats as $habitat): ?>
            <tr>
                <td><?= htmlspecialchars($habitat->name); ?></td>
                <td><?= htmlspecialchars($habitat->description ?? 'Non défini'); ?></td>
                <td><?= !empty($habitat->commentaire) ? htmlspecialchars($habitat->commentaire) : 'Pas de commentaire'; ?></td>
                <td>
                    <?php if (!empty($habitat->img)): ?>
                        <img src="/assets/img/<?= htmlspecialchars($habitat->img); ?>" alt="Photo de l'habitat" class="image-list">
                    <?php else: ?>
                        Pas d'image
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/DashHabitats/edit/<?= $habitat->id; ?>">Éditer l'habitat</a> |
                    <a href="/DashHabitats/delete/<?= $habitat->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet habitat ?');">Supprimer</a>
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