<?php
$css = "filesDashboard";
?>

<form action="/DashHabitats/addHabitat" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

    <div>
        <label for="name">Nom de l'Habitat :</label>
        <input type="text" id="name" name="name" placeholder="Entrez le nom de l'habitat" required>
    </div>

    <div>
        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4" placeholder="Ajoutez une description pour l'habitat" required></textarea>
    </div>

    <div>
        <label for="img">Image de l'Habitat :</label>
        <input type="file" id="img" name="img" accept="image/*" required>
    </div>

    <button type="submit">Ajouter l'Habitat</button>
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