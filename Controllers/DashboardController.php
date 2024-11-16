<?php
// Gestion de l'affichage du dashboard pour les utilisateurs connectés
namespace App\Controllers;

class DashboardController extends Controller
{
    public function index()
    {

        if (isset($_SESSION['id'])) { // Vérifie si l'utilisateur est connecté en vérif la variable id (si oui, on renvoi la vue avec $this->render)
            $this->render('Dashboard/index');
        }
    }
}
