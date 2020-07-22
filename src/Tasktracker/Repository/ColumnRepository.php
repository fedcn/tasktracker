<?php

namespace App\Repository;

use App\Tasktracker\Entity\Column;

interface ColumnRepository
{
    public function findAll(): array;
    
    public function findAllForBoard(Board $board): array;
    
    public function create(Column $column);
    
    public function update(Column $column);
}
