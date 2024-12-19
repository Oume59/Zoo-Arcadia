<?php
$css = "dashboard";
?>

<div class="stylee"></div>
<!-- les href sont les controllers concérnés / la function -->
<div class="container-fluid admin-container">
    <div class="admin-dash">
        <div class="row">

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/DashAnimaux" class="admin-link">Ajouter un animal</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListAnimaux/list" class="admin-link">Liste des animaux</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Species" class="admin-link">Ajouter une Espèce</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListSpecies/list" class="admin-link">Liste des Espèces</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/AddUsers" class="admin-link">Ajouter un Utilisateur</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListUsers/list" class="admin-link">Liste des Utilisateurs</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/DashHabitats" class="admin-link">Ajouter un Habitat</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListHabitats/list" class="admin-link">Liste des Habitats</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/DashServices" class="admin-link">Ajouter un Service</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListServices/list" class="admin-link">Liste des Services</a> <!--DASH ADMIN OK-->
            </div>


            <!--DASH VETO  -->
            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Reports" class="admin-link">Ajouter un Rapport Animal</a> <!--DASH VETO OK -->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListReports/list" class="admin-link">Liste des rapports Animaux</a> <!--DASH VETO + ADMIN + EMPLOYE OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Consultation/list" class="admin-link">Nombre de consultations par animal</a> <!--DASH ADMIN OK-->
            </div>

            <!--DASH EMPLOYE -->
            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Reviews" class="admin-link">Avis à valider</a>
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Reviews/list" class="admin-link">Liste des avis</a>
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Horaires" class="admin-link">Horaires</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Horaires/list" class="admin-link">Liste des Horaires</a> <!--DASH ADMIN OK-->
            </div>

        </div>
    </div>

</div>