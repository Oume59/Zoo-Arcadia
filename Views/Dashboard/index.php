<?php
$css = "dashboard";
?>

<div class="stylee"></div>
<!-- les href sont les controllers concérnés / la methode -->
<div class="container-fluid admin-container">
    <div class="admin-dash">
        <div class="row">

            <!-- autorisations Administrateur -->
            <?php if ($_SESSION['role'] === 'administrateur') : ?>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashUsers" class="admin-link">Ajouter un Utilisateur</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashUsers/list" class="admin-link">Liste des Utilisateurs</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashHabitats" class="admin-link">Ajouter un Habitat</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashHabitats/list" class="admin-link">Liste des Habitats</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashServices" class="admin-link">Ajouter un Service</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashServices/list" class="admin-link">Liste des Services</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashAnimaux" class="admin-link">Ajouter un Animal</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashAnimaux/list" class="admin-link">Liste des Animaux</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashSpecies" class="admin-link">Ajouter une Espèce</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashSpecies/list" class="admin-link">Liste des Espèces</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashReports/list" class="admin-link">Liste des Rapports vétérinaire</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/Reviews/listReviews" class="admin-link">Liste des Avis</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/ConsultationsAnimals/getAllCounts" class="admin-link">Consultations clics/Animal</a>
                </div>
            <?php endif; ?>

            <!-- autorisations Vétérinaire -->
            <?php if ($_SESSION['role'] === 'veterinaire') : ?>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashReports" class="admin-link">Ajouter un Rapport Animal</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashReports/list" class="admin-link">Liste des Rapports</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashHabitats/list" class="admin-link">Liste des Habitats</a>
                </div>
            <?php endif; ?>


            <!-- autorisations Employé -->
            <?php if ($_SESSION['role'] === 'employe') : ?>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/Reviews/pending" class="admin-link">Avis à Valider</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/Reviews/listReviews" class="admin-link">Liste des Avis</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashServices/list" class="admin-link">Liste des Services</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashReports" class="admin-link">Ajouter un rapport de nourriture quotidienne/Animal</a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                    <a href="/DashReports/list" class="admin-link">Nourriture Quotidienne des Animaux</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>