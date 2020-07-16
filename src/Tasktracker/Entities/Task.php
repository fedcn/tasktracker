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
     * @ORM\Column(type="integer")
     */
    private $column;
    
    
    private $name;
    private $description;
    private $order;
    
    private $created_at;
    private $changed_at;
    private $deadline_at;
}
