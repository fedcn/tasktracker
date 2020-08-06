<?php

namespace App\Tasktracker\Form;

use Symfony\Component\Validator\Constraints as Assert;

class UserForm
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
    
    private $allowedAttributes = ['email', 'name'];
    
    public static function createFromModel(User $model)
    {
        $form = new self();
        $form->email = $model->email;
        $form->name = $model->name;
        return $form;
    }
}
