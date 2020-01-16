<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/", name="food.index")
     * @param FoodRepository $repository
     * @return Response
     */
    public function index(FoodRepository $repository)
    {
        $foods = $repository->findAll();
        return $this->render('food/index.html.twig', [
            "foods" => $foods
        ]);
    }
}
