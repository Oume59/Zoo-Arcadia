<link rel="stylesheet" href="/assets/css/listDashboard.css">

<p>Liste des Animaux</p>

<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Espèce</th>
            <th>Habitat</th>
            <th>Photo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($animaux as $animal): ?>
            <tr>
                <td><?php echo htmlspecialchars($animal->name); ?></td>
                <td><?php echo htmlspecialchars($animal->animal_species ?? 'Non défini'); ?></td>
                <td><?php echo htmlspecialchars($animal->habitat_name ?? 'Non défini'); ?></td>
                <td> <?php if (!empty($animal->img)): ?>
                        <img src="/assets/img/<?php echo htmlspecialchars($animal->img); ?>" alt="Photo de l'animal" style="max-width: 50px; max-height: 50px;">
                    <?php else: ?>
                        Pas d'image
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/ListAnimaux/edit/<?php echo $animal->id; ?>">Éditer l'animal</a> |
                    <a href="/ListAnimaux/delete/<?php echo $animal->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">Supprimer</a>
                </td>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>