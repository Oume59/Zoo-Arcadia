<?php
echo '<link rel="stylesheet" href="/assets/css/filesDashboard.css">';
?>


<form action="/species/index" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <div>
        <label for="species">Espèce :</label>
        <input type="text" id="species" name="species" required>
    </div>

    <button type="submit">Ajouter l'Espèce</button>
</form>

<!-- Messages de succès ou d'erreur -->
<?php if (isset($_SESSION['success_message'])) : ?>
    <p style="color: green;"><?php echo $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
    <p style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>