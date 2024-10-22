// Formulaire de connexion user (nav bar) + faire un echo php du link css quand il sera ok
<form action="/user/authenticate" method="post">
    <div>
        <label for="email">Email STAFF :</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="role">Rôle :</label>
        <select id="role" name="role" required>
            <option value="" disabled selected>Sélectionnez votre rôle</option>
            <option value="administrateur">Administrateur</option>
            <option value="employe">Employé</option>
            <option value="veterinaire">Vétérinaire</option>
        </select>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Connexion</button>
</form>