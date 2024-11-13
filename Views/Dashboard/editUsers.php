<!-- Modifier la liste utilisateur depuis le dashboard de l'admin -->

<p>Éditer l'utilisateur</p>

<form action="/ListUsers/edit/<?php echo $user->id ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user->username); ?>" required>
    <br>

    <label>Email :</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
    <br>

    <label>Rôle :</label>
    <select id="role" name="id_role" required>
        <option value="">Sélectionnez un rôle</option>
        <?php foreach ($roles as $role): ?>
            <option value="<?php echo $role->id; ?>" <?php echo ($role->id == $user->id_role) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($role->role); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>