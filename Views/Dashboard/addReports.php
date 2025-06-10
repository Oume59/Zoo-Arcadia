<?php
$css = "filesDashboard";
?>

    <form action="/DashReports/addReport" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <?php if ($_SESSION['role'] === 'veterinaire'): ?>

        <div>
            <label for="date_report">Date du Rapport :</label>
            <input type="date" id="date_report" name="date_report" required>
        </div>

        <div>
            <label for="details">Détails :</label>
            <textarea id="details" name="details"></textarea>
        </div>

        <div>
            <label for="health_state">État de Santé :</label>
            <input type="text" id="health_state" name="health_state">
        </div>

        <div>
            <label for="food">Nourriture Recommandée:</label>
            <input type="text" id="food" name="food">
        </div>

        <?php elseif ($_SESSION['role'] === 'employe' || $_SESSION['role'] === 'veterinaire') : ?>
        <div>
            <label>Animal :</label>
            <select name="animal_id" required>
                <option value="">Sélectionner un animal</option>
                <?php foreach ($animals as $animal): ?>
                    <option value="<?= $animal->id; ?>"><?= $animal->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Description de la nourriture :</label>
            <textarea name="daily_food" placeholder="Exemple : 2 kg de viande, 1 pomme" required></textarea>
        </div>

        <div>
            <label>Date :</label>
            <input type="date" name="daily_food_date" value="<?= date('Y-m-d'); ?>" required>
        </div>

        <div>
            <label>Heure :</label>
            <input type="time" name="daily_food_time" value="<?= date('H:i'); ?>" required>
        </div>

        <?php endif; ?>

        <button type="submit">Ajouter</button>
    </form>


<!-- Messages de succès ou d'erreur -->
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
