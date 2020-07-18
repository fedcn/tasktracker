<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use App\Tasktracker\Entity\Column;

class ColumnRepository extends ServiceEntityRepository
{
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Column::class);
    }
    
    public function getQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('this')->select('this');

        return $qb;
    }
    
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Tasktracker\Entity\Column c
            ORDER BY c.order ASC'
        );

        return $query->getResult();
    }
    
    public function findAllForBoard($board): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Tasktracker\Entity\Column c
            INNER JOIN App\Tasktracker\Entity\Board b On b.id = c.board_id
            WHERE b.id = :board_id
            ORDER BY c.order ASC'
        )->setParameter('board_id', $board->id);

        return $query->getResult();
    }
}
