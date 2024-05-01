<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Stripe\PaymentIntent;
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
    #[Route('/paiement', name: 'paiement')]

    public function paiement(Request $request): Response
    {
        // Configurez Stripe avec votre clé secrète
        Stripe::setApiKey('sk_test_51P9xooKS9crHgin9f4XHcMNvw2rdfrsvDCtgEsZ7IPdsSdr89vXxMKTb3hKJNivarJjg9rQe1gd9tHdOr2X40mNi000NQZSzOf');
    
        // Récupérer toutes les commandes
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findAll();
    
        // Calculer le montant total à payer
        $total = 0;
        foreach ($commandes as $commande) {
            $total += $commande->getSomme() * $commande->getQuantite();
        }
    
        try {
            // Créer un paiement avec Stripe
            $paymentIntent = PaymentIntent::create([
                'amount' =>  $total * 100, // Convertir le montant en centimes
                'currency' => 'eur', // Devise
                
            ]);
    
            // Vérifier si $paymentIntent est null
            if ($paymentIntent === null || !isset($paymentIntent->client_secret)) {
                throw new \Exception('Une erreur s\'est produite lors de la création du paiement.');
            }
    
            // Rediriger l'utilisateur vers la page de paiement de Stripe
            return $this->render('paiement/paiement.html.twig', [
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            // Gérer les erreurs de paiement
            return $this->render('erreur_paiement.html.twig', [
                'message' => $e->getMessage() ?: 'Une erreur s\'est produite lors du paiement. Veuillez réessayer plus tard.'
            ]);
        }
        
    }
    


    #[Route('/paiement/reussi', name: 'paiement_reussi')]
    public function paiementReussi(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        // Marquer toutes les commandes comme payées
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findAll();
        foreach ($commandes as $commande) {
        $produit = $commande->getIdproduit();
        $produit->setQauntiteproduit($produit->getQauntiteproduit() - $commande->getQuantite());
        $entityManager->remove($commande);
        $entityManager->flush();

        }

       

        return $this->render('paiement/reussi.html.twig');
    }

    #[Route('/paiement/annule', name: 'paiement_annule')]
    public function paiementAnnule(): Response
    {
        return $this->render('paiement/annule.html.twig');
    }
    /**
 * @Route("/update_quantity/{id}", name="update_quantity", methods={"POST"})
 */
public function updateQuantity(Request $request, Commande $commande): Response
{
    $quantite = $request->request->get('quantite');

    $commande->setQuantite($quantite);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();

    return new Response('Quantité mise à jour avec succès', Response::HTTP_OK);
}
   
}
