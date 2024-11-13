<?php // Ajout et gestion des animaux

namespace App\Controllers;

use App\Models\AnimauxModel;

class AnimauxController extends Controller
{
    private $animauxModel;

    public function __construct()
    {
        // Initialisation du modèle
        $this->animauxModel = new AnimauxModel();
    }

    public function index()
    {
        // Récupération de la liste des animaux avec leurs espèces
        $animaux = $this->animauxModel->getAnimalsWithSpecies();
        $this->render('Dashboard/addAnimaux', ['animaux' => $animaux]);
    }

    public function addAnimal()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données de la requête POST
            $name = $_POST['name'] ?? null;
            $health_state = $_POST['health_state'] ?? null;
            $species_id = $_POST['species_id'] ?? null;

            // Validation des données (exemple basique)
            if ($name && $health_state && $species_id) {
                // Utilisation des setters du modèle
                $this->animauxModel->setName($name)
                    ->setHealth_State($health_state)
                    ->setSpecies_Id($species_id)
                    ->addAnimal();

                // Redirection ou message de succès
                header("Location: /Animaux"); // Redirige vers la liste des animaux
                exit;
            } else {
                // Message d'erreur pour données manquantes
                $error = "Merci de remplir tous les champs.";
            }
        }

        // Chargement de la vue avec les espèces disponibles pour le formulaire
        $species = $this->animauxModel->getSpecies();
        $this->render('Dashboard/addAnimaux', ['species' => $species, 'error' => $error ?? null]);
    }
}
