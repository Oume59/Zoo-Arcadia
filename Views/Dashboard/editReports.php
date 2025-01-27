<?php
$css = "editDashboard";
?>

<!-- Formulaire pour les vétérinaires -->
<h4>Modification du rapport vétérinaire</h4>
<form action="/DashReports/edit/<?php echo $report->id; ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <?php if ($_SESSION['role'] === 'veterinaire'): ?>

        <label>Date du Rapport :</label>
        <input type="date" name="date_report" value="<?php echo htmlspecialchars($report->date_report); ?>" required>
        <br>

        <label>Détails :</label>
        <textarea name="details" required><?php echo htmlspecialchars($report->details); ?></textarea>
        <br>

        <label>État de Santé :</label>
        <input type="text" name="health_state" value="<?php echo htmlspecialchars($report->health_state); ?>" required>
        <br>

        <label>Nourriture (Recommandée) :</label>
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

<?php elseif($_SESSION['role'] === 'employe'): ?>

<!-- Formulaire pour les employés -->
    <h4>Consommation alimentaire donnée sur la journée</h4>
    

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

        <label>Description de la nourriture :</label>
        <textarea name="daily_food" placeholder="Exemple : 2 kg de viande, 1 pomme" required></textarea>
        <br>

        <label>Date :</label>
        <input type="date" name="daily_food_date" value="<?php echo date('Y-m-d'); ?>" required>
        <br>

        <label>Heure :</label>
        <input type="time" name="daily_food_time" value="<?php echo date('H:i'); ?>" required>
        <br>

        <?php endif; ?>
        <button type="submit">Enregistrer les modifications</button>
    </form>

<!-- Affichage des messages de succès ou d'erreur -->
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