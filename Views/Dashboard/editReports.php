<?php
$css = "editDashboard";
?>

<form action="/ListReports/edit/<?php echo $report->id; ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Date du Rapport :</label>
    <input type="date" name="date_report" value="<?php echo htmlspecialchars($report->date_report); ?>" required>
    <br>

    <label>Détails :</label>
    <textarea name="details" required><?php echo htmlspecialchars($report->details); ?></textarea>
    <br>

    <label>État de Santé :</label>
    <input type="text" name="health_state" value="<?php echo htmlspecialchars($report->health_state); ?>" required>
    <br>

    <label>Nourriture :</label>
    <input type="text" name="food" value="<?php echo htmlspecialchars($report->food); ?>" required>
    <br>

    <label>Animal :</label>
    <select name="animal_id" required>
        <option value="">Sélectionner un animal</option>
        <?php foreach ($animals as $animal): ?>
            <option value="<?php echo $animal->id; ?>" <?php echo ($animal->id == $report->animal_id) ? 'selected' : ''; ?>>
                <?php echo $animal->name; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>

<?php if (isset($_SESSION['success_message'])) : ?>
    <p style="color: green;"><?php echo $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
    <p style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
