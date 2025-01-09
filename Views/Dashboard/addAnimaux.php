<?php
$css = "filesDashboard";
?>

<form action="/DashAnimaux/addAnimal" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div>
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="health_state">État de santé :</label>
        <input type="text" id="health_state" name="health_state" required>
    </div>

    <div>
        <label for="species">Espèce :</label>
        <select id="species" name="species_id" required>
            <?php foreach ($species as $spe) : ?>
                <option value="<?php echo $spe->id ?>"><?php echo $spe->species ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="habitat">Habitat :</label>
        <select id="habitat" name="habitat_id" required>
            <?php foreach ($habitats as $habitat) : ?>
                <option value="<?php echo $habitat->id ?>"><?php echo $habitat->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="img">Image Animal :</label>
        <input type="file" id="img" name="img" required>
    </div>

    <button type="submit">Ajouter l'animal</button>
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