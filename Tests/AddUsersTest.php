<?php

namespace App\Tests;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\UserModel;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class AddUsersTest extends TestCase
{
    public function testSearchUtilisateur() 
    {
        // Charger les variables d'environnement
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $emailTest = 'joseoumearcadia@gmail.com'; // Définit l'email à tester

        $userModel = new UserModel();

        $result = $userModel->searchByEmail($emailTest); // Test qui va chercher le user en BDD (méthode présente dans le model)

        // Vérification si autres éléments présents dans cette email sont remplient
        $this->assertNotNull($result->id);
        $this->assertNotNull($result->username);
        $this->assertNotNull($result->id_role);
        $this->assertNotNull($result->password);
    }
}
