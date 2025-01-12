<?php
$css = "listDashboard";
?>

<h3>Liste des Avis validés</h3>

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
                <td><?= htmlspecialchars($review['avis']) ?></td>
                <td><?= str_repeat('⭐', $review['note']) ?></td>
                <td><?= htmlspecialchars($review['date'] ?? 'Non spécifié') ?></td>
                <td>
                    <a href="/Reviews/deleteValidatedReview/<?php echo $review['_id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');"> Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- BUTTON RETURN -->
<div class="centered">
    <a href="/Dashboard" class="btn-back">QUITTER</a>
</div>