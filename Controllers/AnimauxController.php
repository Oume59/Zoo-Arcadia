<?php

namespace App\Controllers;


class AnimauxController extends Controller
{

        public function index()
    {
        // Renvoyer la vue d'Animaux visiteurs
        $this->render("Animaux/index");
    }
}
