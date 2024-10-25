// Formulaire add utilisateurs (employé/vétérinaire)

<form action="index.php?controller=user&action=addUser" method="POST">
    <label for="email">Email :</label>
    <input type="email" name="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>

    <label for="role">Rôle :</label>
    <select name="role" required>
        <option value="1">administrateur</option>
        <option value="2">veterinaire</option>
        <option value="3">employe</option>
    </select>

    <button type="submit">Créer l'utilisateur</button>
</form>