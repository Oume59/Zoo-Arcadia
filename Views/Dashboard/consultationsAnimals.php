<?php
$css = "listDashboard";
?>

<h3>Consultation des Clics/cartes des animaux du Zoo :</h3>

<table class="animal-table" id="animalTable">
    <thead>
        <tr>
            <th>Animal
                <select id="animalFilter" onchange="filterAnimals()">
                    <option value="">Tous</option>
                    <?php
                    $animals = array_unique(array_column($counts, 'animals'));
                    foreach ($animals as $animal) {
                        echo "<option value='$animal'>$animal</option>";
                    }
                    ?>
                </select>
            </th>
            <th>Nombre de consultations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($counts as $item): ?>
            <tr class="animal-row">
                <td><?= htmlspecialchars($item['animals']) ?></td>
                <td><?= htmlspecialchars($item['views_consultations']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- BUTTON RETURN -->
<div class="centered">
    <a href="/Dashboard" class="btn-back">QUITTER</a>
</div>

<!-- SCRIPT POUR FILTRE/ANIMAL -->
<script>
    function filterAnimals() {
        const filterValue = document.getElementById('animalFilter').value.toLowerCase();
        const rows = document.querySelectorAll('.animal-row');

        rows.forEach(row => {
            const animal = row.cells[0].textContent.toLowerCase();
            if (filterValue === "" || animal === filterValue) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>