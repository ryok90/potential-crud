<?php

namespace PotentialCrud\V1\Rest\Developer;

use Application\Entity\Developer;
use Application\Service\DeveloperService;
use Application\Repository\DeveloperRepository;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Exception;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\Hydrator\HydratorPluginManager;
use Laminas\Stdlib\Parameters;


class DeveloperResource extends AbstractResourceListener
{
    /**
     * @var DeveloperService
     */
    protected $service;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var HydratorPluginManager
     */
    protected $hydratorManager;

    public function __construct(DeveloperService $service, EntityManager $entityManager, HydratorPluginManager $hydratorManager)
    {
        $this->service = $service;
        $this->entityManager = $entityManager;
        $this->hydratorManager = $hydratorManager;
    }

    /**
     * Recupera repository dado entity::class
     * @param string $repository
     * @return DeveloperRepository
     */
    protected function getRepository($repository = Developer::class)
    {
        return $this->entityManager->getRepository($repository);
    }

    /**
     * Recupera o hydrator do Doctrine
     * @return DoctrineObject
     */
    protected function getHydrator()
    {
        return $this->hydratorManager->get(DoctrineObject::class);
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data = $this->getInputFilter()->getValues();
        $developer = $this->getHydrator()->hydrate($data, new Developer());

        try {
            return $this->service->insert($developer);
        } catch (Exception $exception) {
            return new ApiProblem(500, 'Internal server error');
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $developer = $this->getRepository()->findOneBy(['id' => $id]);

        if (!$developer instanceof Developer) {
            return new ApiProblem(404, 'Entity not found');
        }

        try {
            return $this->service->delete($developer);
        } catch (Exception $exception) {
            return new ApiProblem(500, 'Internal server error');
        }
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        try {
            return $this->getRepository()->findOneBy(['id' => $id]);
        } catch (Exception $exception) {
            return new ApiProblem(500, 'Internal server error');
        }
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param Parameters $whitelistParams
     * @return ApiProblem|mixed
     */
    public function fetchAll($whitelistParams = [])
    {
        try {
            $developers = $this->getRepository()->findByWithPagination($whitelistParams->toArray()) ?? [];

            return $developers;
        } catch (Exception $exception) {
            return new ApiProblem(500, 'Internal server error');
        }
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        try {
            $developer = $this->getRepository()->findOneBy(['id' => $id]);

            if (!$developer instanceof Developer) {
                return new ApiProblem(404, 'Entity not found');
            }
            $data = $this->getInputFilter()->getValues();
            $developer = $this->getHydrator()->hydrate($data, $developer);

            return $this->service->update($developer);
        } catch (Exception $exception) {
            return new ApiProblem(500, 'Internal server error');
        }
    }
}
