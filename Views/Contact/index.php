<link rel="stylesheet" href="/assets/css/editDashboard.css">

<h2>Contactez-nous</h2>

<?php if (!empty($message)): ?>
    <p style="color: <?= strpos($message, 'succès') !== false ? 'green' : 'red'; ?>;">
        <?= $message; ?>
    </p>
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
        <label for="message">Message :</label>
        <textarea id="message" name="message" placeholder="Votre message" rows="5" required></textarea>
    </div>

    <button type="submit">Envoyer</button>
</form>
