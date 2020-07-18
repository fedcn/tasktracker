<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Tasktracker\Entity\Task;

class TaskRepository extends ServiceEntityRepository
{
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }
    
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Tasktracker\Entity\Task t
            ORDER BY t.order ASC'
        );

        return $query->getResult();
    }
    
    public function findAllForColumn($column): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Tasktracker\Entity\Task t
            INNER JOIN App\Tasktracker\Entity\Column c On t.column_id = c.id
            WHERE c.id = :column_id
            ORDER BY t.order ASC'
        )->setParameter('column_id', $column->id);

        return $query->getResult();
    }
    
    public function findAllForBoard($board): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Tasktracker\Entity\Task t
            LEFT JOIN App\Tasktracker\Entity\Column c On t.column_id = c.id
            LEFT JOIN App\Tasktracker\Entity\Board b On b.id = c.board_id
            WHERE b.id = :board_id
            ORDER BY t.order ASC'
        )->setParameter('board_id', $board->id);

        return $query->getResult();
    }
}
