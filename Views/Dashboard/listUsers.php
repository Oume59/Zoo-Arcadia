<link rel="stylesheet" href="/assets/css/listDashboard.css">

<p>Liste des Utilisateurs</p>

<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user->username); ?></td>
                <td><?php echo htmlspecialchars($user->email); ?></td>
                <td><?php echo htmlspecialchars($user->user_role); ?></td>
                <td>
                    <a href="/ListUsers/edit/<?php echo $user->id; ?>">Éditer l'utilisateur</a> |
                    <a href="/ListUsers/delete/<?php echo $user->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                </td>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>