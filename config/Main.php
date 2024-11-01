<?php

namespace App\Config;

use App\Controllers\MainController;

class Main
{
    public function start()
    {
        session_start();

        // Génération d'un token CSRF si il n'existe pas
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // génére un token aléatoire
        }

        // On récupére l'url de la requête
        $uri = $_SERVER['REQUEST_URI'];

        // Verif que uri n'est pas vide et se termine par un /
        if (!empty($uri) && $uri != '/' && $uri[-1] === "/") {
            // On enlève le /
            $uri = substr($uri, 0, -1);

            // Envoi un code de redirection permanent
            http_response_code(301);

            // Redirection vers l'url sans /
            header('Location: ' . $uri);
        }

        // Vérif le token CSRF pour les requêtes POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrfToken = $_POST['csrf_token'] ?? '';
            $this->chekCsrfToken($csrfToken);

            // Assainissement des données en POST (nettoie les data pour supprimer tout contenu non sûr ou inutile)
            $_POST = $this->sanitizeFormData($_POST);
        }

        // Gestion des paramètre d'URL + p=controleur/methode/paramètres et séparation des paramètres dans un tableau
        $params = isset($_GET['p']) ? explode('/', filter_var($_GET['p'], FILTER_SANITIZE_URL)) : [];

        // Vérif s'il y a un controleur spécifié;
        if (isset($params[0]) && $params[0] != '') {
            // Récupération du controleur a instancier
            $controllerName = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';

            if (class_exists($controllerName)) {
                // Créer une instance du controleur
                $controller = new $controllerName();
            } else {
                http_response_code(404); // Si controleur n'existe pas, renvoi erreur
                exit();
            }

            // Récupération du 2 eme paramètre d'url pour l'action a éxécuter
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if (method_exists($controller, $action)) {
                // Si il reste des paramètres on les passent à la méthode
                call_user_func_array([$controller, $action], $params);
            } else {
                http_response_code(404); // Si la méthode existe pas, erreur renvoyée
                echo "la page recherchée n'existe pas";
            }
        } else {
            // On instancie le controleur principal par defaut si pas de params
            $controller = new MainController();

            // Appel de la methode index
            $controller->index();
        }
    }

    public function chekCsrfToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) { // Vérif si le token CSRF est valide
            http_response_code(403); // Si token invalide, envoi erreur
            echo "CSRF Token ivalide";
            exit();
        }
    }

    private function sanitizeFormData(array $data)
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) { // Si valeur = tab, elle  appelle la fonction récursivement (la fonction s'appelle elle même)
            if (is_array($value)) { // On utilise à nouveau la fonction sanitizeFormData pour traiter chaque valeur dans tab
                $sanitizedData[$key] = $this->sanitizeFormData($value);
            } else {
                // Enleve les balises HTML des STRINGS uniquement pour éviter les injections de code malveillant dans la page
                if (is_string($value)) {
                    $sanitizedData[$key] = strip_tags($value);
                } else {
                    // Valeur par défaut si ce n'est pas une STRING
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
