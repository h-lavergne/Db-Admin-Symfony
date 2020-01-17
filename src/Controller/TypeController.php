<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/types", name="type.index")
     * @param TypeRepository $repository
     * @return Response
     */
    public function index(TypeRepository $repository)
    {
        $types = $repository->findAll();
        return $this->render('type/index.html.twig', [
            "types" => $types
        ]);
    }

    /**
     * @Route("/type/{id}", name="type.show")
     * @param Type $type
     * @return Response
     */
    public function show(Type $type)
    {
        return $this->render('type/show.html.twig', [
            "type" => $type
        ]);
    }
}
