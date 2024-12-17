<link rel="stylesheet" href="/assets/css/listDashboard.css">

<p>Liste des Habitats</p>

<table class="table-custom">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($habitats as $habitat): ?>
            <tr>
                <td><?php echo htmlspecialchars($habitat->name); ?></td>
                <td><?php echo htmlspecialchars($habitat->description ?? 'Non défini'); ?></td>
                <td>
                    <?php if (!empty($habitat->img)): ?>
                        <img src="/assets/img/<?php echo htmlspecialchars($habitat->img); ?>" alt="Photo de l'habitat" class="image-list">
                    <?php else: ?>
                        Pas d'image
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/ListHabitats/edit/<?php echo $habitat->id; ?>">Éditer l'habitat</a> |
                    <a href="/ListHabitats/delete/<?php echo $habitat->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet habitat ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>