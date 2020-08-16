<?php

namespace PotentialCrudTest\V1\Rest\Developer;

use Application\Service\DeveloperService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\Hydrator\HydratorPluginManager;
use PHPUnit\Framework\TestCase;
use PotentialCrud\V1\Rest\Developer\DeveloperResource;
use PotentialCrud\V1\Rest\Developer\DeveloperResourceFactory;

class DeveloperResourceFactoryTest extends TestCase
{
    protected $traceError = true;

    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $entityManager = $this->prophesize(EntityManager::class);
        $hydratorManager = $this->prophesize(HydratorPluginManager::class);
        $service = $this->prophesize(DeveloperService::class);
        $this->container->get(DeveloperService::class)->willReturn($service->reveal());
        $this->container->get(EntityManager::class)->willReturn($entityManager->reveal());
        $this->container->get(HydratorPluginManager::class)->willReturn($hydratorManager->reveal());
    }

    public function testFactoryInvoke()
    {
        $factory = new DeveloperResourceFactory;
        $result = $factory($this->container->reveal());

        $this->assertInstanceOf(DeveloperResource::class, $result);
    }
}
