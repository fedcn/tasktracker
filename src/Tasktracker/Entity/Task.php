<?php

namespace App\Tasktracker\Entity;

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
     * @ORM\ManyToOne(targetEntity="Column", inversedBy="tasks")
     * @ORM\JoinColumn(name="column_id", referencedColumnName="id")
     */
    private $column;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $order;
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="changed_at", nullable=true)
     */
    private $changedAt;
    
    /**
     * @ORM\Column(type="datetime", name="deadline_at", nullable=true)
     */
    private $deadlineAt;
    
    public function __construct(Column $column, string $name, string $description, int $order)
    {
        $this->column = $column;
        $this->name = $name;
        $this->description = $description;
        $this->order = $order;
        $this->createdAt = new \DateTime();
        $this->changedAt = null;
        $this->deadlineAt = null;
    }
    
    /**
     * @param \App\Tasktracker\Entity\Column $column
     */
    public function setColumn(Column $column)
    {
        $this->column = $column;
        $this->setChangedAt();
    }
    
    public function setName(string $name)
    {
        $this->name = $name;
        $this->setChangedAt();
    }
    
    public function setDescription(string $description)
    {
        $this->description = $description;
        $this->setChangedAt();
    }
    
    public function setOrder(int $order)
    {
        $this->order = $order;
        $this->setChangedAt();
    }
    
    public function setDeadlineAt(DateTime $deadlineAt)
    {
        $this->deadlineAt = $deadlineAt;
        $this->setChangedAt();
    }
    
    protected function setChangedAt()
    {
        $this->changedAt = new \DateTime();
    }
    
    public function isExpired()
    {
        $now = new \DateTimeImmutable();
        return $this->deadlineAt->getTimestamp() < $now->getTimestamp();
    }
}
