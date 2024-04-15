<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ProduitType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
            $file = $form['image']->getData();
            if ($file) {
                // Generate a unique name for the file before saving it
                $fileName = $produit->getNomproduit().'.'.$file->guessExtension();

                // Move the file to the directory where images are stored
                $file->move(
                    $this->getParameter('produit_image_directory'),
                    $fileName
                );
                // Set the image path on the entity
                $produit->setImage($fileName);
            }
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('ajoutproduit');
        }

        return $this->render('produit/ajout.html.twig', ['form' => $form->createView()]);
    }
    
}
