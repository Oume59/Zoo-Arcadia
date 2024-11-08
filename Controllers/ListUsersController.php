<?php

namespace App\Controllers;

use App\Models\UserModel;

class ListUsersController extends Controller
{
    //public function index()
    //{
    //  $this->render('Dashboard/listUsers');
    //}

    public function list()
    {
        $userModel = new UserModel();
        $users = $userModel->selectAllRole();
        if (isset($_SESSION['id'])) {
            $this->render(
                'Dashboard/listUsers',
                [
                    'users' => $users // Envoie la liste cimplète des utilisateurs
                ]
            );
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id); // Utilise la méthode find de Model.php pour récup un utilisateur spécifique de la BDD 

        if ($user) {
            // Renvoi la vue pour éditer l'utilisateur
            $this->render('Dashboard/editUsers', ['user' => $user]);
        } else {
            http_response_code(404);
            echo "Utilisateur non trouvé";
        }
    }

    public function delete($id) // Utiliser la méthode delete pour supp un utilisateur de la BDD
    {
        $userModel = new UserModel();
        $userModel->delete($id); // héritée de Model.php

        // Rediriger vers la liste des utilisateurs après la suppression
        header('Location: Dashboard/listUsers');
        exit();
    }

    public function update($id) // Traiter la soumission du formulaire de la modif de la liste des utilisateurs
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel();
            $userModel->setIdUsers($id)
                ->setUsername($_POST['username'])
                ->setEmail($_POST['email'])
                ->setIdRole($_POST['role']);

            $userModel->update($id); // Appelle la méthode update héritée de Model

            // Rediriger vers la liste des utilisateurs après la MAJ
            header('Location: Dashboard/editUsers');
            exit();
        }
    }
}
