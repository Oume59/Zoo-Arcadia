<?php
//Router principal qui s'occupe de la logique de traitement : requêtes + redirection des flux dans l'app côté serveur 
namespace App\Config;

use App\Controllers\MainController;

//Routeur principal
class Main
{
    public function start()
    { //Démarrage de la session
        session_start();

        //Récupération de l'url actuelle
        $uri = $_SERVER['REQUEST_URI'];

        //SI l'URL se termine par /, on le retire pour normaliser l'url
        if (!empty($uri) && $uri != '/' && $uri[-1] === "/") {
            //On enlève le dernier / et on redirige avec code de redirection 
            $uri = substr($uri, 0, -1);
            http_response_code(301);
            header('Location: ' . $uri);
            exit();
        }
        //Récup et séparation des paramètres de l'URL
        $params = isset($_GET['p']) ? explode('/', htmlspecialchars($_GET['p'])) : [];

        //SI des paramètres sont présents dans l'URL
        if (!empty($params) && $params[0] != '') {
            //Le nom de controleur avec une 1ere lettre en majuscule + récupération du controleur a instancier
            $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';

            if (class_exists($controller)) {
                //Après vérif de l'existence du controleur, on l'instancie
                $controller = new $controller();
            } else { //SINON redirection vers une page d'errreur
                http_response_code(404);
                echo "la page recherchée n'existe pas";
                exit();
            }
            //Récup de la méthode ou index par defaut + vérification de son existence
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if (method_exists($controller, $action)) {
                //SI il reste des paramètres, on les passe à la méthode ET si méthode existe pas, afficher un message d'erreur
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            } else {
                http_response_code(404);
                echo "la page recherchée n'existe pas";
            }
        } else {
            //SI 0 paramètres passé, on utilise le controleur par defaut
            $controller = new MainController();
            //Quand Controleur insatencié, appel automatique de la méthode index() pour rendre page accueil OU vue par defaut
            $controller->index();
        }
    }
}