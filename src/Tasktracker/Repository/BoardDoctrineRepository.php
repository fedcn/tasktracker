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
}
