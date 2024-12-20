<?php

namespace App\Controllers;

use App\Models\SpeciesModel;

class SpeciesController extends Controller
{

    public function index()
    {

        $SpeciesModel = new SpeciesModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $SpeciesModel->hydrate($_POST)->create();
            // Redirection après l'ajout
            header('Location: /ListSpecies/list');
            exit();
        }
        $species = $SpeciesModel->findAll();
        $this->render('Dashboard/addSpecies', ['species' => $species]);
    }
}
