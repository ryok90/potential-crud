<?php

namespace ApplicationTest\Repository;

use Application\Repository\DeveloperRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Laminas\Paginator\Paginator;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class DeveloperRepositoryTest extends TestCase
{
    protected $traceError = true;

    /**
     * @var DeveloperRepository
     */
    protected $developerRepository;

    protected function setUp(): void
    {
        $any = Argument::any();
        $this->entityManager = $this->prophesize(EntityManager::class);
        $queryBuilder = $this->prophesize(QueryBuilder::class);
        $queryBuilder->select($any)->willReturn($queryBuilder->reveal());
        $queryBuilder->from($any, $any, $any)->willReturn($queryBuilder->reveal());
        $queryBuilder->expr($any)->willReturn(new Expr());
        $queryBuilder->andWhere($any)->willReturn();
        $queryBuilder->getQuery($any)->willReturn();
        $this->entityManager->createQueryBuilder()->willReturn($queryBuilder->reveal());
        $this->developerRepository = new DeveloperRepository($this->entityManager->reveal(), new ClassMetadata(Developer::class));
    }

    public function testFindAllWithPaginator()
    {
        $result = $this->developerRepository->findByWithPagination(['teste', 'teste']);

        $this->assertInstanceOf(Paginator::class, $result);
    }

    public function testFindAllWithPaginatorNullParam()
    {
        $result = $this->developerRepository->findByWithPagination(['teste', null]);

        $this->assertInstanceOf(Paginator::class, $result);
    }
}