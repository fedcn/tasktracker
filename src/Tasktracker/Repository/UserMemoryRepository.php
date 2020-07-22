<?php

namespace App\Tasktracker\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Tasktracker\Entity\User;

class UserMemoryRepository implements UserRepository
{
    /**
     * @var User
     */
    private $users = [];
    
    public function findAll(): array
    {
        return $this->users;
    }

    public function create(User $user)
    {
        return;
    }

    public function findByPk(int $id): ?User
    {
        return null;
    }

    public function update(User $user)
    {
        return;
    }
}
