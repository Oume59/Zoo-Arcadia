<?php
$css = "listDashboard";
?>

<h3>Liste des Services</h3>

<table class="table-custom">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($services)): ?>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service->name); ?></td>
                    <td><?php echo htmlspecialchars($service->description); ?></td>
                    <td>
                        <?php if (!empty($service->img)): ?>
                            <img src="/assets/img/<?php echo htmlspecialchars($service->img); ?>" alt="Image du service" class="image-list">
                        <?php else: ?>
                            Pas d'image
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/DashServices/edit/<?php echo $service->id; ?>">Modifier</a> |
                        <a href="/DashServices/delete/<?php echo $service->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun service disponible.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Messages de succès ou d'erreur -->
<?php if (isset($_SESSION['success_message'])): ?>
    <p style="color: green;"><?php echo $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<!-- BUTTON RETURN -->
<div class="centered">
<a href="/Dashboard" class="btn-back">QUITTER</a>
</div>