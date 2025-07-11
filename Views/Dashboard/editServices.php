<?php
$css = "editDashboard";
?>

<h3>Modifier le service</h3>

<form action="/DashServices/edit/<?= $service->id; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

    <div>
        <label for="name">Nom du service :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($service->name); ?>" required>
    </div>

    <div>
        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($service->description); ?></textarea>
    </div>

    <div>
        <label>Image actuelle :</label>
        <br>
        <?php if (!empty($service->img)): ?>
            <img src="/assets/img/<?= htmlspecialchars($service->img); ?>" alt="Image du service" class="image-edit">
        <?php else: ?>
            <p>Aucune image disponible</p>
        <?php endif; ?>
    </div>

    <div>
        <label for="img">Modifier l'image :</label>
        <input type="file" id="img" name="img" accept="image/*">
    </div>

    <button type="submit">Enregistrer les modifications</button>
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