<?php

namespace App\Tasktracker\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="boards")
 */
class Board
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    private $name;
    private $description;
    
    private $owner;
    private $participants;
    
    public function __construct(string $name, User $owner, array $participants = [], string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->owner = $owner;
        $this->participants = $participants;
    }
    
    public function invite(User $participant)
    {
        //
    }
    
    public function remove(User $participant)
    {
        //
    }
    
    public function setDescription(string $value)
    {
        $this->description = $value;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function setName(string $value)
    {
        $this->name = $value;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
}
