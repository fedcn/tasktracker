<?php

namespace App\Tasktracker\Form;

class BaseForm
{
    private $errors = [];
    private $isSubmitted = false;
    private $allowedAttributes = [];
    
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
    
    public function load(array $data)
    {
        $allowedAttributes = $this->allowedAttributes;
        
        foreach ($allowedAttributes as $attr) {
            if (isset($data[$attr])) {
                $this->isSubmitted = true;
                $this->$attr = $data[$attr];
            }
        }
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
