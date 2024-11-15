<!-- Formulaire créa nouveau utilisateur rôle employé/vétérinaire -->
<?php
echo '<link rel="stylesheet" href="/assets/css/filesDashboard.css">';
?>


<form action="/Animaux/addAnimal" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div>
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="health_state">État de santé :</label>
        <input type="text" id="health_state" name="health_state" required>
    </div>

    <div>
        <label for="species">Espèce :</label>
        <select id="species" name="species_id" required>
            <option value="">Sélectionnez une espèce</option>
            <option value="1">Tigre du Bengale</option>
            <option value="2">Éléphant d'Afrique</option>
            <option value="3">Girafe du Niger</option>
            <option value="4">Flamant rose</option>
            <option value="5">Jaguar</option>
            <option value="6">Gorille de l'Est</option>
            <option value="7">Crocodile du Nil</option>
            <option value="8">Rhinocéros blanc</option>
            <option value="9">Tortue des marais</option>
            <option value="10">Lion d'Afrique</option>
            <option value="11">Hyène tachetée</option>
            <option value="12">Hippopotame commun</option>
            <option value="13">Python réticulé</option>
        </select>
    </div>

    <div>
        <label for="habitat">Habitat :</label>
        <select id="habitat" name="habitat_id" required>
            <option value="">Sélectionnez un habitat</option>
            <option value="1">Savane</option>
            <option value="2">Jungle</option>
            <option value="3">Marais</option>
        </select>
    </div>

    <div>
        <label for="image">Image Animal :</label>
        <input type="file" id="image" name="image" required>
    </div>

    <button type="submit">Ajouter l'animal</button>
</form>

<!-- Messages de succès ou d'erreur -->
<?php if (isset($_SESSION['success_message'])) : ?>
    <p style="color: green;"><?php echo $_SESSION['success_message']; ?></p>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
    <p style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>