<?php
$css = "editReviewsDashboard";
?>

<h3>Avis en attente de validation</h3>

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
        <?php foreach ($pendingReviews as $review): ?>
            <tr>
                <td><?= htmlspecialchars($review['pseudo']); ?></td>
                <td><?= htmlspecialchars($review['avis']); ?></td>
                <td><?= str_repeat('⭐', $review['note']); ?></td>
                <td><?= htmlspecialchars($review['date'] ?? 'Non spécifié'); ?></td>
                <td>
                    <form action="/Reviews/validateReview" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($review['_id']); ?>">
                        <button type="submit" class="action-validate">Valider</button>
                    </form>
                    <form action="/Reviews/deleteReview" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($review['_id']); ?>">
                        <button type="submit" class="action-delete">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Affichage des messages de succès ou d'erreur -->
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