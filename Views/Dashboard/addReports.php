<?php
echo '<link rel="stylesheet" href="/assets/css/filesDashboard.css">';
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
        <label for="animal">Animal :</label>
        <select id="animal" name="name" required>
            <option value=""> Sélectionner un Animal </option>
            <?php if (!empty($animals)) : ?>
                <?php foreach ($animals as $animal) : ?>
                    <option value="<?= $animal->name; ?>"><?= $animal->name; ?></option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="" disabled>Aucun animal disponible</option>
            <?php endif; ?>
        </select>
    </div>

    <button type="submit">Ajouter le Rapport</button>
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