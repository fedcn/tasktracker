<?php

namespace App\Tasktracker\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="columns")
 */
class Column
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $board;
    
    private $name;
    private $order;
    
    /**
     * @param string $name
     * @param \App\Tasktracker\Entities\Board $board
     * @param int $order, порядок предыдущей колонки для той же доски
     * @return void
     */
    public function __construct(string $name, Board $board, int $order)
    {
        $this->board = $board;
        $this->name = $name;
        $this->order = $order + 1;
    }
    
    public function move(Column $from, Column $to)
    {
        $fromOrder = $from->order;
        $from->order = $to->order;
        $to->order = $fromOrder;
    }
    
    public function setName(string $name)
    {
        $this->name = $name;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
}
