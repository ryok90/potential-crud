<?php

namespace ApplicationTest\Service\Factory;

use Application\Service\DeveloperService;
use Application\Service\Factory\DeveloperServiceFactory;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;

class DeveloperServiceFactoryTest extends TestCase
{
    protected $traceError = true;

    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $entityManager = $this->prophesize(EntityManager::class);
        $this->container->get(EntityManager::class)->willReturn($entityManager->reveal());
    }

    public function testFactoryInvoke()
    {
        $factory = new DeveloperServiceFactory;
        $result = $factory($this->container->reveal(), '', []);

        $this->assertInstanceOf(DeveloperService::class, $result);
    }
}