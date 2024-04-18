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
    #[Route('/affichageproduit', name: 'app_produit')]
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
                $fileName = $produit->getNomproduit().'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('produit_image_directory'),
                    $fileName
                );
                // Set the image path on the entity
                $produit->setImage($fileName);
            }
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit');
        }

        return $this->render('produit/ajout.html.twig', ['form' => $form->createView()]);
    }
    #[Route('/modifierproduit/{id}', name: 'modifierproduit')]
    public function modifierProduit(Request $request,$id): Response
    {
        $produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->find($id);
    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $file = $form['image']->getData();

        // Si un fichier est téléchargé
        if ($file) {
            // Récupérer le nom de fichier existant
            $oldFileName = $produit->getImage();

            // Supprimer l'ancien fichier s'il existe
            if ($oldFileName) {
                $oldFilePath = $this->getParameter('produit_image_directory') . '/' . $oldFileName;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Générer un nom unique pour le fichier
            $fileName = $produit->getNomproduit() . '.' . $file->guessExtension();

            // Déplacer le fichier vers le répertoire où les images sont stockées
            $file->move(
                $this->getParameter('produit_image_directory'),
                $fileName
            );

            // Mettre à jour le chemin de l'image sur l'entité
            $produit->setImage($fileName);
        }

        $entityManager->persist($produit);
        $entityManager->flush();

        return $this->redirectToRoute('app_produit');
    }

    return $this->render('produit/modif.html.twig', ['form' => $form->createView()]);
    }
    
    #[Route('/supprimerproduit/{id}', name: 'supprimerproduit')]
    public function supprimerProduit(Produit $produit): Response
    {
        $en = $this->getDoctrine()->getManager();
        $en->remove($produit);
        $en->flush();

        return $this->redirectToRoute('app_produit');
    }
    #[Route('/boutique', name: 'app_boutique')]
    public function Boutique(): Response
    {
        $Produits = $this->getDoctrine()->getManager()->getRepository(Produit::class)->findAll();

        return $this->render('produit/boutique.html.twig', [
            'produits'=>$Produits
        ]);
    }
    #[Route('/boutiquelist', name: 'boutique_list')]
    public function BoutiqueList(): Response
    {
        $Produits = $this->getDoctrine()->getManager()->getRepository(Produit::class)->findAll();

        return $this->render('produit/boutiqueList.html.twig', [
            'produits'=>$Produits
        ]);
    }
    
}
