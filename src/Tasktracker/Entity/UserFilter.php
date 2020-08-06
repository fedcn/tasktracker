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
    
    private $errors = [];
    private $isSubmitted = false;
    
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
    
    public function load(array $data)
    {
        $allowedAttributes = ['email', 'name'];
        
        foreach ($allowedAttributes as $attr) {
            if (isset($data[$attr])) {
                $this->isSubmitted = true;
                $this->$attr = $data[$attr];
            }
        }
    }
    
    public static function createFromModel(User $model)
    {
        $form = new self();
        $form->email = $model->email;
        $form->name = $model->name;
        return $form;
    }
    
    public function isValid()
    {
        $this->errors = [];
        foreach ($this->validator->validate(self)->getIterator() as $error) {
            if (isset($this->errors[$error->getPropertyPath()])) {
                $this->errors[$error->getPropertyPath()] .= " " . $error->getMessage();
            } else {
                $this->errors[$error->getPropertyPath()] = $error->getMessage();
            }
        }
        return count($this->errors) === 0;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    public function isSubmitted()
    {
        return $this->isSubmitted;
    }
}
