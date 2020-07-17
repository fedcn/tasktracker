<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{

    public function __construct()
    {
    }
    
    /**
     * @Route("/heroes/{id}", name="get_one_hero", methods={"GET"})
     */
    public function get(string $id): object
    {
        $hero = $this->heroRepository->findOneBy(['id' => $id]);
        
        return $this->json($hero->toArray());
    }
}
