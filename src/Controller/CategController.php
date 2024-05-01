<?php

namespace App\Controller;

use App\Entity\CategTerrain;
use App\Entity\Terrain;
use App\Form\CategTerrainType;
use App\Form\TerrainType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategController extends AbstractController
{


    #[Route('/categ',name: 'addCategorie' )]
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getManager()->getRepository(CategTerrain::class)->findAll();

        return $this->render('categ/index.html.twig', [
            'c'=>$categories
        ]);
    }

    /**
     * @Route("/category/newCat", name="new_category")
     * Method({"GET", "POST"})
     */
    public function newCategory(Request $request) {
        $category = new CategTerrain();
        $form = $this->createForm(CategTerrainType::class,$category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $terrain = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->render('Categ/CategTerrain.html.twig',['form'=>
            $form->createView()]);
    }

    #[Route('/deleteCateg/{id}', name: 'deleteCateg')]
    public function deleteCateg(CategTerrain $terrain): Response
    {
        $en = $this->getDoctrine()->getManager();
        $en->remove($terrain);
        $en->flush();
        return $this->redirectToRoute('addCategorie') ;
    }

    #[Route('/modifCateg/{id}', name: 'modifCateg')]
    public function modifTerrain(Request $request,$id): Response
    {
        $terrain = $this->getDoctrine()->getManager()->getRepository(CategTerrain::class)->find($id) ;
        $form = $this->createForm(CategTerrainType::class,$terrain) ;
        $form->handleRequest($request);
        if ($form -> isSubmitted() && $form->isValid()){
            $en = $this->getDoctrine()->getManager();
            $en->flush();
            return $this->redirectToRoute('addCategorie'); // thezni lel page /Categ itha mrigel
        }
        return $this->render('categ/updateCateg.html.twig',['c'=>$form->createView()]);
    }



}
