<?php
$css = "listDashboard";
?>

<h3>Rapports Vétérinaires et Données Alimentaires</h3>

<div class="table-wrapper">
    <table class="table-custom" id="animalReportTable">
        <thead>
            <tr>
                <th>Date du Rapport</th>
                <th>Détails</th>
                <th>État de Santé</th>
                <th>Nourriture recommandée (Vétérinaire)</th>
                <th>Nourriture donnée sur la journée (Employé)</th>
                <th>Animal
                    <select id="animalFilter" onchange="filterAnimalReports()">
                        <option value="">Tous</option>
                        <?php
                        $animals = array_unique(array_column($reports, 'animal_name'));
                        foreach ($animals as $animal):
                        ?>
                            <option value="<?= $animal ?>"><?= $animal ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $report): ?>
                <tr class="animal-row">
                    <td><?= ($report->date_report); ?></td>
                    <td><?= ($report->details); ?></td>
                    <td><?= ($report->health_state); ?></td>
                    <td><?= ($report->food); ?></td>
                    <td><?= !empty($report->daily_food) ? nl2br(($report->daily_food)) : 'Aucune donnée entrée'; ?></td>
                    <td><?= ($report->animal_name); ?></td>
                    <td>
                        <?php if ($_SESSION['role'] === 'veterinaire' || $_SESSION['role'] === 'employe'): ?>
                            <a href="/DashReports/edit/<?= $report->id; ?>">Modifier</a>
                            <a href="/DashReports/delete/<?= $report->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">Supprimer</a>
                        <?php else: ?>
                            <p class="error-message">Vous n'avez pas les droits pour modifier ou supprimer ce rapport.</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<!-- Messages de succès ou d'erreur -->
<?php if (isset($_SESSION['success_message'])): ?>
    <p style="color: green;"><?= $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <p style="color: red;"><?= $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

    <!-- BUTTON RETURN -->
    <div class="centered">
        <a href="/Dashboard" class="btn-back">QUITTER</a>
    </div>
</div>

<!-- SCRIPT POUR FILTRE/ANIMAL -->
<script>
    function filterAnimalReports() {
        const filterValue = document.getElementById('animalFilter').value.toLowerCase();
        const rows = document.querySelectorAll('.animal-row');

        rows.forEach(row => {
            const animal = row.cells[5].textContent.toLowerCase();
            if (filterValue === "" || animal === filterValue) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
