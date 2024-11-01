<?php

namespace App\controllers;

class DeconnexionController extends Controller
{
    // Efface toutes les variables de session pour déconnecter l'utilisateur, puis les redirige vers la page principale (la fonction ne renvoi rien (pas de return))
    public function index()
    {
        session_unset();

        header("Location: /"); // Cela redirige vers la racine donc vers l'accueil grace au routage
        exit();
    }
}
