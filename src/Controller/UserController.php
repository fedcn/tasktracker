<?php

namespace App\Controller;

use App\Tasktracker\Entity\UserFilter;
use App\Tasktracker\Repository\UserRepository;
use App\Tasktracker\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;
    
    /** @var UserService */
    private $userService;
    
    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }
    
    /**
     * @Route("/users", name="get_users", methods={"GET"})
     * @return object
     */
    public function list(): object
    {
        $users = $this->userRepository->findAll();
        
        return $this->json(array_map(function ($item) {
            return $item->toArray();
        }, $users));
    }
    
    /**
     * @Route("/user/{id}", name="get_user", methods={"GET"})
     */
    public function get(string $id): object
    {
        $user = $this->userRepository->findByPk($id);
        
        if (!$user) {
            return $this->json(['errors' => "not found"], 404);
        }
        
        return $this->json($user->toArray());
    }
    
    /**
     * @param Request $request
     * @return object
     * @Route("/user", name="create_user", methods={"POST"})
     */
    public function create(Request $request): object
    {
        $data = json_decode($request->getContent(), true);
        $form = new UserFilter();
        $form->load($data);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userService->create($form);
            return $this->json($user->toArray());
        }
    
        return $this->json($form->getErrors());
    }
    
    /**
     * @param Request $request
     * @return object
     * @Route("/user/{id}", name="update_user", methods={"PATCH"})
     */
    public function update(string $id, Request $request): object
    {
        $model = $this->userRepository->findByPk($id);
        $form = UserFilter::createFromModel($model);
        $data = json_decode($request->getContent(), true);
        $form->load($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->update($model, $form);
            return $this->json($model);
        }

        return $this->json($form->getErrors());
    }
}
