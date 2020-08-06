<?php

namespace App\Tasktracker\Service;

use App\Tasktracker\Entity\Board;
use App\Tasktracker\Form\BoardForm;
use App\Tasktracker\Repository\BoardRepository;

class BoardService
{
    /** @var BoardRepository */
    private $boardRepository;
    
    public function __construct(BoardRepository $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }
    
    public function create(BoardForm $form): ?Board
    {
        $model = new Board($form->name, $form->owner, $form->description);
        try {
            $this->boardRepository->create($model);
            return $model;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    public function update(Board $model, BoardForm $form): bool
    {
        $model->setName($form->name);
        $model->setOwner($form->owner);
        $model->setDescription($form->description);
        try {
            $this->boardRepository->update($model);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
