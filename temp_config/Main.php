<?php

namespace App\Config;

use App\Controllers\MainController;

class Main
{
    public function start()
    {
        session_start();

        //Génération d'un token CSRF (s'il n'existe pas)
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        //Récupération de l'url
        $uri = $_SERVER['REQUEST_URI'];

        //Vérification que uri n'est pas vide et se termine par un /
        if (!empty($uri) && $uri != '/' && $uri[-1] === "/") {
            //Retirer le /
            $uri = substr($uri, 0, -1);

            //chekCsrfTokenode de redirection permanent
            http_response_code(301);

            //Redirection vers l'url sans /
            header('Location: ' . $uri);
        }

        //Vérif du jeton CSRF et assainit DATA POST si la requete est de type POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrfToken = $_POST['csrf_token'] ?? '';
            $this->chekCsrfToken($csrfToken);

            //Assainissement des DATA en POST
            $_POST = $this->sanitizeFormData($_POST);
        }

        //Gestion des params d'URL
        //p=controleur/methode/paramètres et séparation des paramètres dans un tableau
        $params = isset($_GET['p']) ? explode('/', filter_var($_GET['p'], FILTER_SANITIZE_URL)) : [];

        if (isset($params[0]) && $params[0] != '') {
            //Récupération du controleur à instancier
            //Majuscule en 1 er lettre et ajout du namespace complet avant et ajout du "controller" après
            $controllerName = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';

            if (class_exists($controllerName)) {
                //on Instencie le controleur
                $controller = new $controllerName();
            } else {
                $this->error404("Controler non trouvé : $controllerName");
                return;
            }

            //Récupération du second paramètre d'url
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if (method_exists($controller, $action)) {
                //S'il reste des paramètres on les passent à la méthode
                call_user_func_array([$controller, $action], $params);
            } else {
                $this->error404("Méthode non trouvée : $action");
                return;
            }
        } else {
            //Instencie le controleur par defaut car pas de paramètres
            $controller = new MainController();

            //Appel de la méthode index
            $controller->index();
        }
    }
    
    public function chekCsrfToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) { // Vérif si le token CSRF est valide
            http_response_code(403); //Si token invalide, envoi erreur
            echo "CSRF Token ivalide";
            exit();
        }
    }

    private function sanitizeFormData(array $data)
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) { //Si valeur = tab, elle  appelle la fonction récursivement (la fonction s'appelle elle même)
            if (is_array($value)) { //On utilise à nouveau la fonction sanitizeFormData pour traiter chaque valeur dans tab
                $sanitizedData[$key] = $this->sanitizeFormData($value);
            } else {
                //Enleve les balises HTML des STRINGS uniquement pour éviter les injections de code malveillant dans la page
                if (is_string($value)) {
                    $sanitizedData[$key] = strip_tags($value);
                } else {
                    //Valeur par défaut si ce n'est pas une STRING
                    $sanitizedData[$key] = $value;
                }
            }
        }
        return $sanitizedData;
    }

    private function error404($message)
    {
        http_response_code(404);
        echo $message;
    }
}
