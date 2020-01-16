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
            "foods" => $foods,
            "isCalorie" => false,
            "isCarbohydrate" => false
        ]);
    }

    /**
     * @Route("/food/less-calorie/{calorie}", name="food.per.calorie")
     * @param FoodRepository $repository
     * @param $calorie
     * @return Response
     */
    public function FoodsLessCaloric(FoodRepository $repository, $calorie)
    {
        $foods = $repository->getFoodByProperty("calorie", "<", $calorie);
        return $this->render('food/index.html.twig', [
            "foods" => $foods,
            "isCalorie" => true,
            "isCarbohydrate" => false
        ]);
    }

    /**
     * @Route("/food/less-carbohydrate/{carbohydrate}", name="food.per.carbohydrate")
     * @param FoodRepository $repository
     * @param $carbohydrate
     * @return Response
     */
    public function getFoodWithLessCarbohydrate(FoodRepository $repository, $carbohydrate)
    {
        $foods = $repository->getFoodByProperty("carbohydrate", "<", $carbohydrate);
        return $this->render('food/index.html.twig', [
            "foods" => $foods,
            "isCalorie" => false,
            "isCarbohydrate" => true
        ]);
    }


}
