<!-- Formulaire de connexion user (nav bar) + faire un echo php du link css quand il sera ok -->
<form action="/User/login" method="POST">
    <div>
        <label for="email">Email STAFF :</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Connexion</button>
</form>