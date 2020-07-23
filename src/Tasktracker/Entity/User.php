<?php

namespace App\Tasktracker\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", unique=True)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Board", mappedBy="users")
     */
    private $ownedBoards;
    
    /**
     * @ORM\ManyToMany(targetEntity="Board", inversedBy="users")
     * @ORM\JoinTable(name="ref_users_boards")
     */
    private $participantBoards;
    
    public function __construct(string $name, string $email)
    {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException("User name must not be empty");
        }
        if (empty(trim($email))) {
            throw new \InvalidArgumentException("User email must not be empty");
        }
        $this->name = $name;
        $this->email = $email;
        $this->participantBoards = new ArrayCollection();
        $this->ownedBoards = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOwnedBoards()
    {
        return $this->ownedBoards;
    }

    public function getParticipantBoards()
    {
        return $this->participantBoards;
    }
    
    public function toArray()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
        ];
    }
}
