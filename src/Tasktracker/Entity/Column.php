<?php

namespace App\Tasktracker\Entity;

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
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="columns")
     * @ORM\JoinColumn(name="board_id", referencedColumnName="id")
     */
    private $board;
    
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="columns")
     */
    private $tasks;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $order;
    
    /**
     * @param string $name
     * @param \App\Tasktracker\Entity\Board $board
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
