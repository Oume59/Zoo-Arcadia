<?php
$css = "editDashboard";
?>
<!-- Modifier la liste utilisateur depuis le dashboard de l'admin -->

<h3>Éditer l'utilisateur</h3>

<form action="/DashUsers/edit/<?php echo $user->id ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user->username); ?>" required>
    <br>

    <label>Email :</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
    <br>

    <label>Rôle :</label>
    <select id="role" name="id_role" required>
        <option value="">Sélectionnez un rôle</option>
        <?php foreach ($roles as $role): ?>
            <?php if ($role->id != 1): ?> <!-- Exclut l'administrateur de la liste comme demandé dans le sujet à la demande de José-->
                <option value="<?php echo $role->id; ?>" <?php echo ($role->id == $user->id_role) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($role->role); ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>

<!-- Messages de succès ou d'erreur -->
<?php if (isset($_SESSION['success_message'])) : ?>
    <p class="success-message"><?php echo $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
    <p class="error-message"><?php echo $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<!-- BUTTON RETURN -->
<div class="centered">
<a href="/Dashboard" class="btn-back">QUITTER</a>
</div>