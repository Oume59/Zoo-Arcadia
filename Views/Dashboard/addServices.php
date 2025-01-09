<?php
$css = "filesDashboard";
?>

<form action="/DashServices/addService" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div>
        <label for="name">Nom du service :</label>
        <input type="text" id="name" name="name" placeholder="Nom du service" required>
    </div>

    <div>
        <label for="description">Description :</label>
        <textarea id="description" name="description" placeholder="Description du service" required></textarea>
    </div>

    <div>
        <label for="img">Image :</label>
        <input type="file" id="img" name="img" accept="image/*">
    </div>

    <button type="submit">Ajouter le service</button>
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