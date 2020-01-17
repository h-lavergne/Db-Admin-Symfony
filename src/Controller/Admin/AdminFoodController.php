<?php

namespace App\Controller\Admin;

use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFoodController extends AbstractController
{
    /**
     * @Route("/admin/food", name="admin.food.index")
     * @param FoodRepository $repository
     * @return Response
     */
    public function index(FoodRepository $repository)
    {
        $foods = $repository->findAll();
        return $this->render('admin/food/index.html.twig', [
            "foods" => $foods
        ]);
    }

    /**
     * @Route("/admin/edit-food/{id}", name="admin.food.edit")
     * @param Food $food
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Food $food, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(FoodType::class, $food);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($food);
            $em->flush();
            $this->addFlash("success", "You successfully edit ". $food->getName() );
            return $this->redirectToRoute("admin.food.index");
        }

        return $this->render('admin/food/edit.html.twig', [
            "food" => $food,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/create-food", name="admin.food.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(FoodType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash("success", "Successful create");
            return $this->redirectToRoute("admin.food.index");
        }

        return $this->render('admin/food/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/delete-food/{id}", name="admin.food.delete", methods="delete")
     * @param Food $food
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Food $food, EntityManagerInterface $em, Request $request)
    {
        if ($this->isCsrfTokenValid("delete" . $food->getId(), $request->get("_token"))){
            $em->remove($food);
            $em->flush();
            $this->addFlash("success", "Successful delete");
            return $this->redirectToRoute("admin.food.index");
        }
    }
}
