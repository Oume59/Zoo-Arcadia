<?php
$css = "filesDashboard";
?>

<form action="/Dashspecies/addSpecies" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <div>
        <label for="species">Espèce :</label>
        <input type="text" id="species" name="species" required>
    </div>

    <button type="submit">Ajouter l'Espèce</button>
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