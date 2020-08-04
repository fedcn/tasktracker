<?php

namespace App\Tasktracker\Service;

use App\Tasktracker\Entity\User;
use App\Tasktracker\Entity\UserFilter;
use App\Tasktracker\Repository\UserRepository;

class UserService
{
    /** @var UserRepository */
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function create(UserFilter $form): ?User
    {
        $model = new User($form->name, $form->email);
        try {
            $this->userRepository->create($model);
            return $model;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    public function update(User $model): bool
    {
        try {
            $this->userRepository->update($model);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
