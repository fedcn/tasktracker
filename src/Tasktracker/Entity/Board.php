<?php

namespace App\Tasktracker\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Column", mappedBy="boards")
     */
    private $columns;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="boards")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;
    
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="boards")
     */
    private $participants;
    
    /**
     * @param string $name
     * @param \App\Tasktracker\Entity\User $owner
     * @param ArrayCollection $participants
     * @param string $description
     * @TODO: проверить начальное значение $participants
     */
    public function __construct(string $name, User $owner, string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->columns = new ArrayCollection();
        $this->owner = $owner;
        $this->participants = new ArrayCollection();
    }
    
    public function add(User $participant)
    {
        $this->participants[] = $participant;
    }
    
    public function remove(User $participant)
    {
        $this->participants->removeElement($participant);
    }
    
    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
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
