<?php
$css = "editDashboard";
?>

<h3>Contactez-nous</h3>

<?php if (!empty($message)): ?>
    <div class="<?= strpos($message, 'succès') !== false ? 'success-message' : 'error-message'; ?>">
        <?= htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<form action="/Contact/sendContactMail" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

    <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom" required>
    </div>

    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Votre prénom" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" required>
    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Message, objet de votre demande :</label>
        <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Envoyer</button>
</form>

<!-- BUTTON RETURN -->
<div class="centered">
    <a href="/Main" class="btn-back">QUITTER</a>
</div>