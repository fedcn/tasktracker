<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Tasktracker\Entity\User;

class UserDoctrineRepository extends ServiceEntityRepository implements UserRepository
{
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Tasktracker\Entity\User u
            ORDER BY u.id ASC'
        );

        return $query->getResult();
    }
    
    public function findByPk(int $id): ?User
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Tasktracker\Entity\User u
            WHERE u.id = :id
            ORDER BY u.id ASC'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
