<!-- Modifier la liste utilisateur depuis le dash de l'admin -->

<p>Éditer l'utilisateur</p>

<form action="/ListUsers/edit" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user->username); ?>" required>
    <br>

    <label>Email :</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
    <br>

    <label>Rôle :</label>
    <input type="text" name="role" value="<?php echo htmlspecialchars($user->role); ?>" required>
    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>