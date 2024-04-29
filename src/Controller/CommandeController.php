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
    public function ajoutCommande(Request $request, Produit $produit): Response
{
    $entityManager = $this->getDoctrine()->getManager();

    // Récupérer le produit depuis la base de données
    $produit = $entityManager->getRepository(Produit::class)->find($produit->getIdproduit());
    
    // Créer une nouvelle instance de Commande
    $commande = new Commande(); 
    $commande->setIduser(1);
    $commande->setQuantite(1);
    $commande->setSomme($produit->getPrixproduit());
    $commande->setIdproduit($produit);

    // Vérifier si une commande existante pour ce produit existe déjà
    $existingCommande = $entityManager->getRepository(Commande::class)->findOneBy([
        'idproduit' => $produit->getIdproduit()
    ]);

    if ($existingCommande) {
        // Si une commande existe déjà, mettre à jour la quantité et la somme
        
        $existingCommande->setQuantite($existingCommande->getQuantite() + 1);
    } else {
        // Sinon, persister la nouvelle commande
        $entityManager->persist($commande);
    }

    // Persister les changements dans la base de données
    $entityManager->flush();

    // Rediriger vers la page de commande
    return $this->redirectToRoute('app_commande');
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
