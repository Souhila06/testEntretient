<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CategorieController extends AbstractController
{

    /**
     * @Route("/categorie", name="app_categorie")
     */
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $categorie = $entityManager->getRepository(Categorie::class)->findAll();
        return $this->json($categorie);
    }
    public function show(EntityManagerInterface $entityManager, $id): JsonResponse
    {
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);
        return $this->json($categorie);
    }
    public function create(EntityManagerInterface $entityManager): JsonResponse
    {
        $categorie = new Categorie();
        $request = Request::createFromGlobals();
        $data = $request->toArray();
        $categorie->setName($data['name']);
        $categorie->setDescription($data['description']);
        $entityManager->persist($categorie);
        $entityManager->flush();
        return $this->json($categorie);
    }
    public function update(EntityManagerInterface $entityManager, $id): JsonResponse
    {
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        if (!$categorie) {
            throw $this->createNotFoundException(
                'id not found' . $id
            );
        }
        $request = Request::createFromGlobals();
        $data = $request->toArray();
        $categorie->setName($data["name"]);
        $categorie->setDescription($data["description"]);

        $entityManager->flush();
        return $this->json($categorie);
    }
    public function delete(EntityManagerInterface $entityManager, $id): JsonResponse
    {
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        if (!$categorie) {
            throw $this->createNotFoundException(
                'id not found' . $id
            );
        }

        $entityManager->remove($categorie);
        $entityManager->flush();
        return $this->json("Delete successful");
    }
}
