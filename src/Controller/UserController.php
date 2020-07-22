<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * @Route("/users", name="get_users", methods={"GET"})
     * @return object
     */
    public function list(): object
    {
        $users = $this->userRepository->findAll();
        return $this->json($users);
    }
    
    /**
     * @Route("/user/{id}", name="get_user", methods={"GET"})
     */
    public function get(string $id): object
    {
        $user = $this->userRepository->findByPk($id);
        
        return $this->json($user->toArray());
    }
    
    /**
     * @param Request $request
     * @return object
     * @Route("/user", name="create_user", method={"POST"})
     */
    public function create(Request $request): object
    {
        ;
    }
    
    /**
     * @param Request $request
     * @return object
     * @Route("/user/{id}", name="update_user", method={"PATCH"})
     */
    public function update(string $id, Request $request): object
    {
        ;
    }
}
