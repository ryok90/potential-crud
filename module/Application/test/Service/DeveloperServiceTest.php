<?php

namespace ApplicationTeste\Service;

use Application\Entity\Developer;
use Application\Service\DeveloperService;
use Doctrine\ORM\EntityManager;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use PHPUnit\Framework\TestCase;

class DeveloperServiceTest extends TestCase
{
    protected $traceError = true;

    /**
     * @var DeveloperService
     */
    protected $developerService;

    protected function setUp(): void
    {
        $this->entityManager = $this->prophesize(EntityManager::class);
        $this->developerService = new DeveloperService($this->entityManager->reveal());
    }

    public function testInsert()
    {
        $developer = new Developer();
        $result = $this->developerService->insert($developer);

        $this->assertSame($developer, $result);
    }

    public function testInsertExistingDeveloper()
    {
        $developer = new Developer();
        $developer->setId(1);
        $result = $this->developerService->insert($developer);

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testUpdate()
    {
        $developer = new Developer();
        $developer->setId(2);
        $result = $this->developerService->update($developer);

        $this->assertSame($developer, $result);
    }

    public function testUpdateNonExistingDeveloper()
    {
        $developer = new Developer();
        $result = $this->developerService->update($developer);

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testDelete()
    {
        $developer = new Developer();
        $developer->setId(1);
        $result = $this->developerService->delete($developer);

        $this->assertTrue($result);
    }

    public function testDeleteNonExisting()
    {
        $developer = new Developer();
        $result = $this->developerService->delete($developer);

        $this->assertInstanceOf(ApiProblem::class, $result);
    }
}
