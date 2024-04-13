<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ProduitType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        $Produits = $this->getDoctrine()->getManager()->getRepository(Produit::class)->findAll();

        return $this->render('produit/index.html.twig', [
            'b'=>$Produits
        ]);
    }
    #[Route('/ajoutproduit', name: 'ajoutproduit')]
    public function ajoutproduit(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('ajoutproduit');
        }

        return $this->render('produit/ajout.html.twig', ['form' => $form->createView()]);
    }

}
