<?php

namespace App\Tasktracker\Repository;

use App\Tasktracker\Entity\Board;

interface BoardRepository
{
    public function findAll(): array;
    
    public function findByPk(int $id): ?Board;
    
    public function create(Board $model): void;
    
    public function update(Board $model): void;
}
