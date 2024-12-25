<?php
// Gestion de l'affichage du dashboard pour les utilisateurs connectés
namespace App\Controllers;

class DashboardController extends Controller
{
    public function index()
    {

        // Vérifie si l'utilisateur est connecté
        if (isset($_SESSION['id'])) {
            // Vérification des rôles pour personnaliser l'accès
            if ($_SESSION['role'] === 'administrateur') {
                $this->render('Dashboard/index', ['role' => 'administrateur']);
            } elseif ($_SESSION['role'] === 'veterinaire') {
                $this->render('Dashboard/index', ['role' => 'veterinaire']);
            } elseif ($_SESSION['role'] === 'employe') {
                $this->render('Dashboard/index', ['role' => 'employe']);
            } else {
                // Rôle non reconnu
                http_response_code(403);
                echo "Rôle non reconnu. Accès interdit.";
                exit;
            }
        } else {
            // Si l'utilisateur n'est pas connecté
            http_response_code(403);
            echo "Accès interdit. Veuillez vous connecter.";
            exit;
        }
    }
}
