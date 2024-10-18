<?php

namespace App\Controllers;

//Héritage de Controller
class MainController extends Controller
{
    //Méthode pour afficher page d'accueil
    public function index()
    {
        //Renvoyer la vue de accueil
        $this->render("Accueil/accueil");
    }
}
