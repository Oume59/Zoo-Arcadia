<?php
$css = "listDashboard";
?>

<h3>Consultation des Clics/cartes des animaux du Zoo :</h3>

<table class="animal-table">
    <thead>
        <tr>
            <th>Animal</th>
            <th>Nombre de consultations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($counts as $item): ?>
            <tr>
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