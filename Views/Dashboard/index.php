<?php
echo '<link rel="stylesheet" href="/assets/css/dashboard.css">';
?>

<div class="stylee"></div>
<!-- les href sont les controllers concérnés / la function -->
<div class="container-fluid admin-container">
    <div class="admin-dash">
        <div class="row">

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Animaux" class="admin-link">Ajout d'animaux</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListAnimaux/list" class="admin-link">Liste des animaux</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Species" class="admin-link">Ajout Espèce</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListSpecies/list" class="admin-link">Liste Espèces</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/AddUsers" class="admin-link">Ajout d'Utilisateur</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListUsers/list" class="admin-link">Liste des Utilisateurs</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Habitats" class="admin-link">Ajout Habitat</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListHabitats/list" class="admin-link">Liste des Habitats</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Services" class="admin-link">Services</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/ListServices/list" class="admin-link">Liste des Services</a> <!--DASH ADMIN OK-->
            </div>


            <!--DASH VETO  -->
            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Reports" class="admin-link">Ajout Rapport Animal</a> <!--DASH VETO OK -->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Reports/list" class="admin-link">Liste rapports des Animaux</a> <!--DASH ADMIN OK-->
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Consultation/list" class="admin-link">Nombre de consultation par animal</a> <!--DASH ADMIN OK-->
            </div>

            <!--DASH EMPLOYE -->
            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Reviews" class="admin-link">Avis à valider</a>
            </div>

            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Reviews/list" class="admin-link">Liste des avis</a>
            </div>


            <!--DASH EMPLOYE-->
            <div class="col-12 col-sm-6 col-md-3 admin-link-container">
                <a href="/Contact" class="admin-link">Contact</a>
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