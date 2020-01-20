<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\CategoryType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTypeController extends AbstractController
{
    /**
     * @Route("/admin/types", name="admin.type.index")
     * @param TypeRepository $repository
     * @return Response
     */
    public function index(TypeRepository $repository)
    {
        $types = $repository->findAll();
        return $this->render('admin/type/register.html.twig', [
            'types' => $types,
        ]);
    }

    /**
     * @Route("/admin/edit-type/{id}", name="admin.type.edit")
     * @param Type $type
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Type $type, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($type);
            $em->flush();
            $this->addFlash("success", "You successfully edit " . $type->getWording());
            return $this->redirectToRoute("admin.type.index");
        }

        return $this->render('admin/type/edit.html.twig', [
            'type' => $type,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/create-typec", name="admin.type.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash("success", "Successful create");
            return $this->redirectToRoute("admin.type.index");
        }

        return $this->render('admin/type/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/delete-type/{id}", name="admin.type.delete", methods="delete")
     * @param Type $type
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Type $type, EntityManagerInterface $em, Request $request)
    {
        if ($this->isCsrfTokenValid("delete" . $type->getId(), $request->get("_token"))){
            $em->remove($type);
            $em->flush();
            $this->addFlash("success", "Successful delete");
            return $this->redirectToRoute("admin.type.index");
        }
    }
}
