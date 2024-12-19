<?php
$css = "editDashboard";
?>

<h3>Éditer l'espèce</h3>

<form action="/ListSpecies/edit/<?php echo $species->id ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Nom de l'espèce :</label>
    <input type="text" id="species" name="species" value="<?php echo htmlspecialchars($species->species); ?>" required>
    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>