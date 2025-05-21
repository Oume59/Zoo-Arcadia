<?php
$css = "listDashboard";
?>

<h3 class="text-center fw-bold">Liste des Utilisateurs</h3>

<div class="table-wrapper">
<table class="table-custom">
    <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user->username); ?></td>
                <td><?= htmlspecialchars($user->email); ?></td>
                <td><?= htmlspecialchars($user->user_role); ?></td>
                <td>
                    <a href="/DashUsers/edit/<?= $user->id; ?>">Éditer l'utilisateur</a> |
                    <a href="/DashUsers/delete/<?= $user->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
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