<?php

namespace App\Tasktracker\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UserFilter
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *     min = 3,
     *     max = 25,
     *     allowEmptyString = false
     * )
     */
    public $name;
    
    public function load(array $data)
    {
        $this->email = $data['email'] ?? $this->email;
        $this->name = $data['name'] ?? $this->name;
    }
}
