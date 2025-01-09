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

    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
    </div>

    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
    </div>

    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="Votre email" required>
    </div>

    <div>
        <label for="message">Message, objet de votre demande :</label>
        <textarea id="message" name="message" placeholder="Votre message" rows="5" required></textarea>
    </div>

    <button type="submit">Envoyer</button>
</form>

<!-- BUTTON RETURN -->
<div class="centered">
<a href="/Main" class="btn-back">QUITTER</a>
</div>