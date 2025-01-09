<?php
$css = "editDashboard";
?>

<form action="/ListAnimaux/edit/<?php echo $animaux->id; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Nom de l'animal :</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($animaux->name); ?>" required>
    <br>

    <label>Espèce :</label>
    <select name="species_id" required>
        <option value="">Sélectionnez une espèce</option>
        <?php foreach ($species as $specie): ?>
            <option value="<?php echo $specie->id; ?>" <?php echo ($specie->id == $animaux->species_id) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($specie->animal_species); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <label>Habitat :</label>
    <select name="habitat_id" required>
        <option value="">Sélectionnez un habitat :</option>
        <?php foreach ($habitats as $habitat): ?>
            <option value="<?php echo $habitat->id; ?>" <?php echo ($habitat->id == $animaux->habitat_id) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($habitat->habitat_name); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="current_image" class="form-label">Image actuelle :</label>
    <img src="/assets/img/<?php echo htmlspecialchars($animaux->img); ?>" alt="Image de l'animal" class="image-edit">

    <label for="img" class="form-label">Nouvelle image :</label>
    <input type="file" class="form-control" id="img" name="img" accept="image/*">
    <br>

    <button type="submit">Enregistrer les modifications</button>

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