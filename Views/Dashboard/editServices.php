<link rel="stylesheet" href="/assets/css/dashboard.css">

<h2>Modifier le service</h2>

<form action="/ListServices/edit/<?php echo $service->id; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div>
        <label for="name">Nom du service :</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($service->name); ?>" required>
    </div>

    <div>
        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($service->description); ?></textarea>
    </div>

    <div>
        <label>Image actuelle :</label>
        <br>
        <?php if (!empty($service->img)): ?>
            <img src="/assets/img/<?php echo htmlspecialchars($service->img); ?>" alt="Image du service" style="max-width: 150px; max-height: 150px;">
        <?php else: ?>
            <p>Aucune image disponible</p>
        <?php endif; ?>
    </div>

    <div>
        <label for="image">Modifier l'image :</label>
        <input type="file" id="image" name="image" accept="image/*">
    </div>

    <button type="submit">Enregistrer les modifications</button>
</form>

<!-- Messages de succès ou d'erreur -->
<?php if (isset($_SESSION['success_message'])): ?>
    <p style="color: green;"><?php echo $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
