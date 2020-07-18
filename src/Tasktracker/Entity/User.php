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
     * @ORM\Column(type="string")
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
    
    public function __construct()
    {
        $this->participantBoards = new ArrayCollection();
        $this->ownedBoards = new ArrayCollection();
    }
}
