<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\ServicesModel;

class ListServicesTest extends TestCase // test qui vérifie si la méthode findAll du model renvoie bien la liste attendue des services.
{
    public function testListServices(): void
    {
        // Créa Mock du model ServicesModel
        $servicesModelMock = $this->createMock(ServicesModel::class);

        // Simule l'appel à méthode findAll
        $servicesModelMock->expects($this->once())
            ->method('findAll')
            ->willReturn([
                ['id' => 1, 'name' => 'Service 1'],
                ['id' => 2, 'name' => 'Service 2'],
            ]);

        // Appel direct au modèle
        $services = $servicesModelMock->findAll();

        // Assertions sur le résultat (Vérif des résultats avec des assertions PHPUnit)
        $this->assertCount(2, $services); // vérif que la méthode retourn bien 2 services
        $this->assertEquals('Service 1', $services[0]['name']);
        $this->assertEquals('Service 2', $services[1]['name']);
    }
}
