<?php

namespace App\Tasktracker\Repository;

use App\Tasktracker\Entity\User;

interface UserRepository
{
    
    public function findAll(): array;
    
    public function findByPk(int $id): ?User;
    
    public function create(User $user);
    
    public function update(User $user);
}
