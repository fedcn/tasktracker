<?php

namespace App\Repository;

use App\Tasktracker\Entity\Task;

interface TaskRepository
{
    
    public function findAll(): array;
    
    public function findAllForColumn(Column $column): array;
    
    public function findAllForBoard(Board $board): array;
    
    public function findByPk(int $id): ?Task;
    
    public function create(Task $task);
    
    public function update(Task $task);
}
