<?php

namespace PotentialCrudTest\V1\Rest\Developer;

use Application\Entity\Developer;
use Application\Repository\DeveloperRepository;
use Application\Service\DeveloperService;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Exception;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\ResourceEvent;
use Laminas\Hydrator\HydratorPluginManager;
use Laminas\InputFilter\InputFilter;
use Laminas\Paginator\Paginator;
use Laminas\Stdlib\Parameters;
use PHPUnit\Framework\TestCase;
use PotentialCrud\V1\Rest\Developer\DeveloperResource;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class DeveloperResourceTest extends TestCase
{
    protected $traceError = true;

    /**
     * @var ObjectProphecy
     */
    protected $service;

    /**
     * @var ObjectProphecy
     */
    protected $entityManager;

    /**
     * @var ObjectProphecy
     */
    protected $hydratorManager;

    /**
     * @var ObjectProphecy
     */
    protected $event;

    /**
     * @var ObjectProphecy
     */
    protected $inputFilter;

    /**
     * @var ObjectProphecy
     */
    protected $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->prophesize(EntityManager::class);
        $this->hydratorManager = $this->prophesize(HydratorPluginManager::class);
        $this->service = $this->prophesize(DeveloperService::class);
        $this->event = $this->prophesize(ResourceEvent::class);
        $this->inputFilter = $this->prophesize(InputFilter::class);
        $this->repository = $this->prophesize(DeveloperRepository::class);
        $hydrator = $this->prophesize(DoctrineObject::class);
        $parameters = $this->prophesize(Parameters::class);

        $any = Argument::any();
        $hydrator->hydrate($any, $any)->willReturn(new Developer());
        $this->hydratorManager->get(DoctrineObject::class)->willReturn($hydrator->reveal());
        $this->inputFilter->getValues()->willReturn([]);
        $parameters->toArray()->willReturn([]);
        $this->event->getParam('id', $any)->willReturn(1);
        $this->event->getParam('data', $any)->willReturn([]);
        $this->event->getQueryParams()->willReturn($parameters->reveal());
        $this->event->getInputFilter()->willReturn($this->inputFilter->reveal());
    }

    /**
     * Retorna o Subject-under-test com suas dependencias
     * @return DeveloperResource
     */
    protected function getSubject()
    {
        $this->entityManager->getRepository(Developer::class)->willReturn($this->repository->reveal());

        return new DeveloperResource(
            $this->service->reveal(),
            $this->entityManager->reveal(),
            $this->hydratorManager->reveal()
        );
    }

    public function testCreate()
    {
        $this->service->insert(Argument::any())->willReturn(new Developer());
        $this->event->getName()->willReturn('create');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(Developer::class, $result);
    }

    public function testCreateServerError()
    {
        $this->service->insert(Argument::any())->willThrow(new Exception());
        $this->event->getName()->willReturn('create');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testDelete()
    {
        $this->service->delete(Argument::any())->willReturn(true);
        $this->repository->findOneBy(Argument::any())->willReturn(new Developer());
        $this->event->getName()->willReturn('delete');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertTrue($result);
    }

    public function testDeleteNotFound()
    {
        $this->repository->findOneBy(Argument::any())->willReturn();
        $this->event->getName()->willReturn('delete');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testDeleteServerError()
    {
        $this->service->delete(Argument::any())->willThrow(new Exception());
        $this->repository->findOneBy(Argument::any())->willReturn(new Developer());
        $this->event->getName()->willReturn('delete');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testFetch()
    {
        $this->repository->findOneBy(Argument::any())->willReturn(new Developer());
        $this->event->getName()->willReturn('fetch');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(Developer::class, $result);
    }

    public function testFetchServerError()
    {
        $this->repository->findOneBy(Argument::any())->willThrow(new Exception());
        $this->event->getName()->willReturn('fetch');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testFetchAll()
    {
        $paginator = $this->prophesize(Paginator::class);
        $this->repository->findByWithPagination(Argument::any())->willReturn($paginator->reveal());
        $this->event->getName()->willReturn('fetchAll');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(Paginator::class, $result);
    }

    public function testFetchAllServerError()
    {
        $this->repository->findByWithPagination(Argument::any())->willThrow(new Exception());
        $this->event->getName()->willReturn('fetchAll');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testUpdate()
    {
        $this->repository->findOneBy(Argument::any())->willReturn(new Developer());
        $this->service->update(Argument::any())->willReturn(new Developer);
        $this->event->getName()->willReturn('update');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(Developer::class, $result);
    }

    public function testUpdateNotFound()
    {
        $this->repository->findOneBy(Argument::any())->willReturn();
        $this->event->getName()->willReturn('update');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(ApiProblem::class, $result);
    }

    public function testUpdateServerError()
    {
        $this->repository->findOneBy(Argument::any())->willThrow(new Exception());
        $this->event->getName()->willReturn('update');
        $result = $this->getSubject()->dispatch($this->event->reveal());

        $this->assertInstanceOf(ApiProblem::class, $result);
    }
}
