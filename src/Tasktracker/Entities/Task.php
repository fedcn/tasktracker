<?php

namespace App\Tasktracker\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Column", inversedBy="tasks")
     * @ORM\JoinColumn(name="column_id", referencedColumnName="id")
     */
    private $column;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $order;
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="changed_at")
     */
    private $changedAt;
    
    /**
     * @ORM\Column(type="datetime", name="deadline_at")
     */
    private $deadlineAt;
}
