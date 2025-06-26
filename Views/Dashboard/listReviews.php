<?php
$css = "listDashboard";
?>

<h3 class="text-center fw-bold">Liste des Avis Validés</h3>

<div class="table-wrapper">
<table class="table-custom">
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Avis</th>
            <th>Note</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($validatedReviews as $review): ?>
            <tr>
                <td><?= htmlspecialchars($review['pseudo']) ?></td>
                <td><?= htmlspecialchars_decode(htmlspecialchars($review['avis'])) ?></td>
                <td><?= str_repeat('⭐', $review['note']) ?></td>
                <td><?= htmlspecialchars($review['date'] ?? 'Non spécifié') ?></td>
                <td>
                    <a href="/Reviews/deleteValidatedReview/<?= $review['_id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');"> Supprimer</a>
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