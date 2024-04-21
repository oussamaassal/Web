<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    #[Route('/ajoutcommande', name: 'ajoutcommande')]
    public function ajoutCommande(Request $request): Response
    {
        $produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->find(24);
        
        $commande = new Commande();
        $commande->setIduser(1);
        $commande->setQuantite(1);
        $commande->setSomme(100);
        $commande->setIdproduit($produit);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commande);
        $entityManager->persist($produit);
        $entityManager->flush();


        
        


        return $this->redirectToRoute('app_produit');
    }

}
