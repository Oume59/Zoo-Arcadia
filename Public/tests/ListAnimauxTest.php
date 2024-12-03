<?php

namespace Tests;

use PHPUnit\Framework\TestCase; // classe fournie par phpUnit qui permet de lancer le test
use App\Models\AnimauxModel;

class ListAnimauxTest extends TestCase // Test unitaire qui vérifie si controller "ListAnimauxController" utilise bien son model associé pour récup la liste des animaux (avec espèces + habitats) et transmets à la vue.
{
    public function testGetAnimalsWithSpeciesAndHabitat(): void
    {
        // Création d'un Mock pour le modèle AnimauxModel
        $animauxModelMock = $this->getMockBuilder(AnimauxModel::class)
            ->onlyMethods(['req']) // Spécifie que seule la méthode req sera simulée
            ->getMock();

        // Simulation de l'appel à méthode req (pour éxécuter des requêtes SQL)
        // Elle retourne une structure de DATA fictive, comme si elle venait de ma BDD
        $animauxModelMock->expects($this->once()) // On attend que `req` soit appelée une fois
            ->method('req') // On simule la méthode `req`
            ->willReturn(new class {
                public function fetchAll() // La méthode simulée retourne un tableau de données
                {
                    return [
                        ['id' => 1, 'name' => 'Lion', 'species' => 'Mammifère', 'habitat_name' => 'Savane'],
                        ['id' => 2, 'name' => 'Tigre', 'species' => 'Mammifère', 'habitat_name' => 'Jungle'],
                    ];
                }
            });

        // Appel de la méthode à tester getAnimalsWithSpeciesAndHabitat et retourner les donnees simulées
        $result = $animauxModelMock->getAnimalsWithSpeciesAndHabitat();

        // Assertions pour vérif que les DATA retournées par la méthode sont OK
        $this->assertCount(2, $result); // Vérifie que le tab contient bien 2 éléments
        $this->assertEquals('Lion', $result[0]['name']); // Vérifie que le premier animal est "Lion"
        $this->assertEquals('Tigre', $result[1]['name']); // Vérifie que le deuxième animal est "Tigre"
        $this->assertEquals('Savane', $result[0]['habitat_name']); // Vérifie que l'habitat du "Lion" est "Savane"
        $this->assertEquals('Jungle', $result[1]['habitat_name']); // Vérifie que l'habitat du "Tigre" est "Jungle"
    }
}
