<link rel="stylesheet" href="/assets/css/editDashboard.css">

<form action="/ListHabitats/edit/<?php echo $habitat->id; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Nom de l'habitat :</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($habitat->name); ?>" required>
    <br>

    <label>Description :</label>
    <textarea name="description" required><?php echo htmlspecialchars($habitat->description); ?></textarea>
    <br>

    <label>Image actuelle :</label>
    <br>
    <?php if (!empty($habitat->img)): ?>
        <img src="/assets/img/<?php echo htmlspecialchars($habitat->img); ?>" alt="Image de l'habitat" class="image-edit">
    <?php else: ?>
        <p>Aucune image disponible</p>
    <?php endif; ?>
    <br>

    <label>Modifier l'image :</label>
    <input type="file" name="image" accept="image/*">
    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>
