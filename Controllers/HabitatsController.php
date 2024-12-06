<?php

namespace App\Controllers;

use App\Models\HabitatsModel;

class HabitatsController extends Controller
{

    public function index()
    {
        // Renvoyer la vue d'Animaux visiteurs
        $this->render("Habitats/index");
    }
}
