<?php
$css = "filesDashboard";
?>

<form action="/Reports/addReport" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div>
        <label for="date_report">Date du Rapport :</label>
        <input type="date" id="date_report" name="date_report" required>
    </div>

    <div>
        <label for="details">Détails :</label>
        <textarea id="details" name="details" required></textarea>
    </div>

    <div>
        <label for="health_state">État de Santé :</label>
        <input type="text" id="health_state" name="health_state" required>
    </div>

    <div>
        <label for="food">Nourriture :</label>
        <input type="text" id="food" name="food" required>
    </div>

    <div>
    <label>Animal :</label>
    <select name="animal_id" required>
        <option value="">Sélectionner un animal</option>
        <?php foreach ($animals as $animal): ?>
            <option value="<?php echo $animal->id; ?>" ><?php echo $animal->name; ?></option>
        <?php endforeach; ?>
    </select>
    </div>

    <button type="submit">Ajouter le Rapport</button>
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