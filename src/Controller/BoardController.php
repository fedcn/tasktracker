<?php

namespace App\Controller;

use App\Tasktracker\Form\BoardForm;
use App\Tasktracker\Repository\BoardRepository;
use App\Tasktracker\Service\BoardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    /** @var BoardRepository */
    private $boardRepository;
    
    /** @var BoardService */
    private $boardService;
    
    public function __construct(BoardRepository $boardRepository, BoardService $boardService)
    {
        $this->boardRepository = $boardRepository;
        $this->boardService = $boardService;
    }
    
    /**
     * @Route("/boards", name="get_boards", methods={"GET"})
     * @return object
     */
    public function list(): object
    {
        $models = $this->boardRepository->findAll();
        
        return $this->json(array_map(function ($model) {
            return $model->toArray();
        }, $models));
    }
    
    /**
     * @Route("/board/{id}", name="get_board", methods={"GET"})
     */
    public function read(string $id): object
    {
        $model = $this->boardRepository->findByPk($id);
        
        if (!$model) {
            return $this->json(['errors' => "not found"], 404);
        }
        
        return $this->json($model->toArray());
    }
    
    /**
     * @param Request $request
     * @return object
     * @Route("/board", name="create_board", methods={"POST"})
     */
    public function create(Request $request): object
    {
        // TODO: откуда брать пользователя?
        $data = json_decode($request->getContent(), true);
        $form = new BoardForm();
        $form->load($data);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $model = $this->boardService->create($form);
            return $this->json($model->toArray());
        }
    
        return $this->json($form->getErrors());
    }
    
    /**
     * @param Request $request
     * @return object
     * @Route("/board/{id}", name="update_board", methods={"PATCH"})
     */
    public function update(string $id, Request $request): object
    {
        $model = $this->boardRepository->findByPk($id);
        $data = json_decode($request->getContent(), true);
        $form = BoardForm::createFromModel($model);
        $form->load($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->boardService->update($model, $form);
            return $this->json($model->toArray());
        }

        return $this->json($form->getErrors());
    }
}
