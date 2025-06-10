<?php
$css = "editDashboard";
?>


<form action="/DashHabitats/edit/<?= $habitat->id; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

    <label>Nom de l'habitat :</label>
    <input type="text" name="name" value="<?= htmlspecialchars($habitat->name); ?>" required>
    <br>

    <label>Description :</label>
    <textarea name="description" required><?= htmlspecialchars($habitat->description); ?></textarea>
    <br>

    <?php if ($_SESSION['role'] === 'veterinaire'): ?>
        <label>Commentaire Vétérinaire :</label>
        <textarea name="commentaire"><?= htmlspecialchars($habitat->commentaire ?? ''); ?></textarea>
        <br>
    <?php endif; ?>

    <label>Image actuelle :</label>
    <br>
    <?php if (!empty($habitat->img)): ?>
        <img src="/assets/img/<?= htmlspecialchars($habitat->img); ?>" alt="Image de l'habitat" class="image-edit">
    <?php else: ?>
        <p>Aucune image disponible</p>
    <?php endif; ?>
    <br>

    <label>Modifier l'image :</label>
    <input type="file" name="img" accept="image/*">
    <br>

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