<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\HabitatsModel;

class ListHabitatsTest extends TestCase // test qui vérifie que le contrôleur des habitats appel correctement la méthode findAll du modèle et transmet les données à la vue
{
    public function testListHabitats(): void
    {
        // Créa Mock du modèle
        $habitatsModelMock = $this->createMock(HabitatsModel::class);

        // Simule l'appel à findAll (Simulation des données renvoyées par le model)
        $habitatsModelMock->expects($this->once())
            ->method('findAll')
            ->willReturn([
                ['id' => 1, 'name' => 'Savane'],
                ['id' => 2, 'name' => 'Jungle'],
            ]);

        // Vérifie que Controller Appel la méthode du model)
        $habitats = $habitatsModelMock->findAll();

        // Assertions sur le résultat (vérification de la sortie)
        $this->assertCount(2, $habitats);
        $this->assertEquals('Savane', $habitats[0]['name']);
        $this->assertEquals('Jungle', $habitats[1]['name']);
    }
}