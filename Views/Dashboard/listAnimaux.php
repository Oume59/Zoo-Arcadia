<?php
$css = "listDashboard";
?>

<h3 class="text-center fw-bold">Liste des Animaux</h3>

<div class="table-wrapper">
<table class="table-custom">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Espèce</th>
            <th>Habitat</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($animaux as $animal): ?>
            <tr>
                <td><?= htmlspecialchars($animal->name); ?></td>
                <td><?= htmlspecialchars($animal->animal_species ?? 'Non défini'); ?></td>
                <td><?= htmlspecialchars($animal->habitat_name ?? 'Non défini'); ?></td>
                <td> <?php if (!empty($animal->img)): ?>
                        <img src="/assets/img/<?= htmlspecialchars($animal->img); ?>" alt="Photo de l'animal" class="image-list">
                    <?php else: ?>
                        Pas d'image
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/DashAnimaux/edit/<?= $animal->id; ?>">Éditer l'animal</a> |
                    <a href="/DashAnimaux/delete/<?= $animal->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">Supprimer</a>
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