<?php
namespace PotentialCrud\V1\Rest\Developer;

use Application\Service\DeveloperService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\Hydrator\HydratorPluginManager;

class DeveloperResourceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $service = $container->get(DeveloperService::class);
        $entityManager = $container->get(EntityManager::class);
        $hydratorManager = $container->get(HydratorPluginManager::class);

        return new DeveloperResource($service, $entityManager, $hydratorManager);
    }
}
