<?php

namespace App\Tasktracker\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Tasktracker\Entity\Task;

class TaskDoctrineRepository extends ServiceEntityRepository implements TaskRepository
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
    
    public function findAllForColumn(Column $column): array
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
    
    public function findAllForBoard(Board $board): array
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

    public function findByPk(int $id): ?Task
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Tasktracker\Entity\Task t
            WHERE t.id = :id
            ORDER BY t.id ASC'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
    
    public function create(Task $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }
    
    public function update(Task $task): void
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }
    
    public function updateAll(array $tasks): void
    {
        $em = $this->getEntityManager();
        foreach ($tasks as $task) {
            $em->persist($task);
        }
        $em->flush();
    }
}
