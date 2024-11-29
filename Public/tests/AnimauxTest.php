<?php

namespace Tests;

use PHPUnit\Framework\TestCase; // classe fournie par phpUnit qui permet de lancer le test
use App\Controllers\AnimauxController;
use App\Models\AnimauxModel;

class AnimauxTest extends TestCase
{
    public function testAddAnimalSuccess(): void
    {
        // Mock du modèle AnimauxModel
        $animauxModelMock = $this->createMock(AnimauxModel::class); // utiliser Mock pour simuler et éviter d'appeler les dependances

        // Simule le comportement de hydrate et create
        $animauxModelMock->expects($this->once())
            ->method('hydrate')
            ->willReturn($animauxModelMock);

        $animauxModelMock->expects($this->once())
            ->method('create')
            ->willReturn(true);

        // Instancie le contrôleur
        $animauxController = new AnimauxController();
        $animauxController->setAnimauxModel($animauxModelMock); // Injecte le mock

        // Simule les données POST
        $_POST = [
            'name' => 'UNIT',
            'health_state' => 'Excellent',
            'species_id' => 2,
            'habitat_id' => 1,
        ];

        $_FILES = [
            'image' => [
                'tmp_name' => '/tmp/php12345',
                'name' => 'lion.jpg',
                'error' => UPLOAD_ERR_NO_FILE, // Pas de fichier pour simplifier
            ]
        ];

        // Capture la redirection
        $this->expectOutputRegex('/Location: \/Animaux/');

        // Appelle la méthode
        $animauxController->addAnimal();
    }
}
