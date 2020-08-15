<?php
namespace Application\Service\Factory;

use Application\Service\DeveloperService;
use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class DeveloperServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DeveloperService($container->get(EntityManager::class));
    }
}