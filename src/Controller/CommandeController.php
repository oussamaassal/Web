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

       $Commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->findAll();

        return $this->render('commande/index.html.twig', [
            'commande'=>$Commande
        ]);
    }
    #[Route('/ajoutcommande/{id}', name: 'ajoutcommande')]
    public function ajoutCommande(Request $request,Produit $produit): Response
    {
        $produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->find($produit->getIdproduit());
        
        $commande = new Commande(); 
        $commande->setIduser(1);
        $commande->setQuantite(1);
        $commande->setSomme($produit->getPrixproduit());
        $commande->setIdproduit($produit);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commande);
        $entityManager->persist($produit);
        $entityManager->flush();


        
        


        return $this->redirectToRoute('app_produit');
    }
    #[Route('/supprimercommande/{id}', name: 'supprimercommande')]
    public function supprimerCommande(Request $request,Commande $commande): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($commande);
        $entityManager->flush();
        return $this->redirectToRoute('app_commande');
    }

}
