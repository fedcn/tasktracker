<?php

namespace App\Controller;

use App\Tasktracker\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Tasktracker\Form\UserType;
use App\Tasktracker\Entity\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
        return $this->json(array_map(function ($item) {
            return $item->toArray();
        }, $users));
    }
    
    /**
     * @Route("/user/{id}", name="get_user", methods={"GET"})
     */
    public function get(string $id): object
    {
//        var_dump($id);exit;
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
    public function create(Request $request, ValidatorInterface $validator): object
    {
        $data = json_decode($request->getContent(), true);
        $form = new \App\Tasktracker\Entity\UserFilter();
        $form->load($data);
        
        $errors = [];
        foreach ($validator->validate($form)->getIterator() as $error) {
            if (isset($errors[$error->getPropertyPath()])) {
                $errors[$error->getPropertyPath()] .= " " . $error->getMessage();
            } else {
                $errors[$error->getPropertyPath()] = $error->getMessage();
            }
        }
        if (count($errors) == 0) {
            $user = new User($form->name, $form->email);
            $this->userRepository->create($user);
            return $this->redirectToRoute('get_user', ['id' => $user->getId()]);
        }
    
        return $this->json($errors);
    }
    
    /**
     * @param Request $request
     * @return object
     * @Route("/user/{id}", name="update_user", methods={"PATCH"})
     */
    public function update(string $id, Request $request, ValidatorInterface $validator): object
    {
        $updatedModel = $this->userRepository->findByPk($id);
        $form = $this->createForm(UserType::class, $updatedModel);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($updatedModel);exit;
            $this->userRepository->save($updatedModel);
            return $this->json($updatedModel);
        }

        return $this->json($form->getErrors());
        
//        $user = $this->userRepository->findByPk($id);
//        $form = new \App\Tasktracker\Entity\UserFilter();
//        $form->load($user->toArray());
//        $data = json_decode($request->getContent(), true);
//        $form->load($data);
//
//        $errors = [];
//        foreach ($validator->validate($form)->getIterator() as $error) {
//            if (isset($errors[$error->getPropertyPath()])) {
//                $errors[$error->getPropertyPath()] .= " " . $error->getMessage();
//            } else {
//                $errors[$error->getPropertyPath()] = $error->getMessage();
//            }
//        }
//        if (count($errors) == 0) {
//            $user->name = $form->name;
//            $user->email = $form->email;
//            $this->userRepository->update($user);
//            return $this->redirectToRoute('get_user', ['id' => $user->getId()]);
//        }
//
//        return $this->json($errors);
    }
}
