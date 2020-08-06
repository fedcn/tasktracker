<?php

namespace App\Tasktracker\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Tasktracker\Entity\Board;

class BoardDoctrineRepository extends ServiceEntityRepository implements BoardRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Board::class);
    }
    
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT b
            FROM App\Tasktracker\Entity\Board b
            ORDER BY b.id ASC'
        );

        return $query->getResult();
    }

    public function findByPk(int $id): ?Board
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Tasktracker\Entity\Board b
            WHERE b.id = :id
            ORDER BY b.id ASC'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function create(Board $model): void
    {
        $this->getEntityManager()->persist($model);
        $this->getEntityManager()->flush();
    }

    public function update(Board $model): void
    {
        $this->getEntityManager()->persist($model);
        $this->getEntityManager()->flush();
    }
}
