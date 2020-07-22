<?php

namespace App\Tasktracker\Repository;

interface BoardRepository
{
    public function findAll(): array;
}
