<?php

namespace App\Repository;

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
}
