<?php
$css = "editDashboard";
?>

<!-- Formulaire pour les vétérinaires -->
<h4>Modification du rapport vétérinaire</h4>
<form action="/DashReports/edit/<?= $report->id; ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <?php if ($_SESSION['role'] === 'veterinaire'): ?>

        <label>Date du Rapport :</label>
        <input type="date" name="date_report" value="<?= htmlspecialchars($report->date_report); ?>" required>
        <br>

        <label>Détails :</label>
        <textarea name="details" required><?= htmlspecialchars($report->details); ?></textarea>
        <br>

        <label>État de Santé :</label>
        <input type="text" name="health_state" value="<?= htmlspecialchars($report->health_state); ?>" required>
        <br>

        <label>Nourriture (Recommandée) :</label>
        <input type="text" name="food" value="<?= htmlspecialchars($report->food); ?>" required>
        <br>

        <label>Animal :</label>
        <select name="animal_id" required>
            <option value="">Sélectionner un animal</option>
            <?php foreach ($animals as $animal): ?>
                <option value="<?= $animal->id; ?>" <?= ($animal->id == $report->animal_id) ? 'selected' : ''; ?>>
                    <?= $animal->name; ?>
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
                <option value="<?= $animal->id; ?>" <?= ($animal->id == $report->animal_id) ? 'selected' : ''; ?>>
                    <?= $animal->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Description de la nourriture :</label>
        <textarea name="daily_food" placeholder="Exemple : 2 kg de viande, 1 pomme" required></textarea>
        <br>

        <label>Date :</label>
        <input type="date" name="daily_food_date" value="<?= date('Y-m-d'); ?>" required>
        <br>

        <label>Heure :</label>
        <input type="time" name="daily_food_time" value="<?= date('H:i'); ?>" required>
        <br>

        <?php endif; ?>
        <button type="submit">Enregistrer les modifications</button>
    </form>

<!-- Affichage des messages de succès ou d'erreur -->
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