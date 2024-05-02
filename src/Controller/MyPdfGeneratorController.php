<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType; 


class MyPdfGeneratorController
{
    public function generatePdf(EntityManagerInterface $entityManager)
    {
        // Étape 2 : Interrogation de la base de données
        $commandes = $entityManager->getRepository(Commande::class)->findAll();

        // Étape 4 : Génération du contenu HTML
        $html = '<h1>Liste des commandes</h1>';
        foreach ($commandes as $commande) {
            $html .= '<p>ID : ' . $commande->getId() . '</p>';
            $html .= '<p>Utilisateur : ' . $commande->getIduser() . '</p>';
            $html .= '<p>Somme : ' . $commande->getSomme() . '</p>';
            $html .= '<p>Quantité : ' . $commande->getQuantite() . '</p>';
            $html .= '<p>Produit : ' . $commande->getIdproduit() . '</p>';
            $html .= '<hr>';
        }

        // Étape 5 : Conversion en PDF
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Étape 6 : Téléchargement du PDF
        $pdfContent = $dompdf->output();
        
        // Création d'une réponse HTTP avec le contenu du PDF
        $response = new Response($pdfContent);
        
        // Configuration de l'en-tête HTTP pour le téléchargement du fichier
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="liste_commandes.pdf"');
        
        // Retourner la réponse HTTP pour télécharger le PDF
        return $response;
    }
}
