<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Laminas\Paginator\Paginator;

class DeveloperRepository extends EntityRepository
{
    public function findByWithPagination(array $params)
    {
        $queryBuilder = $this->createQueryBuilder('dev');
        $exprBuilder = $queryBuilder->expr();
        
        foreach ($params as $key => $val) {
            $expr = $exprBuilder->eq("dev.$key", $exprBuilder->literal($val));

            if (empty($val)) {
                $expr = $exprBuilder->isNull("dev.$key");
            }
            $queryBuilder->andWhere($expr);
        }
        $paginator = new Paginator(new PaginatorAdapter(new DoctrinePaginator($queryBuilder)));

        return $paginator;
    }
}