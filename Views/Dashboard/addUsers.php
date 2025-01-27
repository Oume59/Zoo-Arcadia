<!-- Formulaire créa nouveau utilisateur rôle employé/vétérinaire -->
<?php
$css = "filesDashboard";
?>

<form action="/DashUsers/addUsers" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <div>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <label for="role">Rôle :</label>
        <select id="role" name="role" required>
            <option value="">Sélectionnez un rôle</option>
            <option value="2">Vétérinaire</option>
            <option value="3">Employé</option>
        </select>
    </div>

    <button type="submit">Ajouter l'utilisateur</button>
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