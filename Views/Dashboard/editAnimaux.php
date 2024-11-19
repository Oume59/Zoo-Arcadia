<link rel="stylesheet" href="/assets/css/editDashboard.css">

<form action="/ListAnimaux/edit/<?php echo $animaux->id; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Nom de l'animal :</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($animaux->name); ?>" required>
    <br>

    <label>État de santé :</label>
    <input type="text" name="health_state" value="<?php echo htmlspecialchars($animaux->health_state); ?>" required>
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

    <label>Image actuelle :</label>
    <br>
    <?php if (!empty($animaux->img)): ?>
        <img src="/assets/img/<?php echo htmlspecialchars($animaux->img); ?>" alt="Image de l'animal" style="max-width: 150px; max-height: 150px;">
    <?php else: ?>
        <p>Aucune image disponible</p>
    <?php endif; ?>
    <br>

    <label>Modifier l'image :</label>
    <input type="file" name="image" accept="image/*">
    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>