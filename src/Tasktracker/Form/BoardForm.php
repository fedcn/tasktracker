<?php

namespace App\Tasktracker\Form;

use Symfony\Component\Validator\Constraints as Assert;

class BoardForm extends BaseForm
{
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
    
    /**
     * @Assert\Type("string")
     * @Assert\Length(
     *     min = 3,
     *     max = 500,
     *     allowEmptyString = true
     * )
     */
    public $description;
    
    /**
     *
     * @var User
     */
    public $owner;
    
    private $owner_id;
    private $participant_ids;
    private $column_ids;

    private $allowedAttributes = ['name', 'description', 'owner'];
    
    public static function createFromModel(Board $model)
    {
        $form = new self();
        $form->name = $model->name;
        $form->description = $model->description;
        $form->owner = $model->owner;
        return $form;
    }
}
