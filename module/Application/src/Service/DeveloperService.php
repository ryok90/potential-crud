<?php
namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Developer;
use Laminas\ApiTools\ApiProblem\ApiProblem;

class DeveloperService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Insere um novo Developer
     * @param Developer $developer
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws OptimisticLockException
     * @return Developer|ApiProblem
     */
    public function insert(Developer $developer)
    {
        if ($developer->getId()) {
            return new ApiProblem(400, 'Developer already registered');
        }
        $this->entityManager->persist($developer);
        $this->entityManager->flush($developer);

        return $developer;
    }

    /**
     * Atualiza um Developer
     * @param Developer $developer
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws OptimisticLockException
     * @return Developer|ApiProblem
     */
    public function update(Developer $developer)
    {
        if (!$developer->getId()) {
            return new ApiProblem(404, 'Developer not found');
        }
        $this->entityManager->persist($developer);
        $this->entityManager->flush($developer);

        return $developer;
    }


    /**
     * Atualiza um Developer
     * @param Developer $developer
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws OptimisticLockException
     * @return bool|ApiProblem
     */
    public function delete(Developer $developer)
    {
        if (!$developer->getId()) {
            return new ApiProblem(404, 'Developer not found');
        }
        $this->entityManager->remove($developer);
        $this->entityManager->flush();

        return true;
    }
}