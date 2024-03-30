<?php

namespace App\Controller;

use App\Repository\JoueurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    #[Route('/joueur', name: 'app_joueur')]
    public function index(): Response
    {
        return $this->render('list.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }

    #[Route('/getJoueurs', name: 'Joueur_list')]
    public function listJoueurs(JoueurRepository $repo):Response{

        $list = $repo->findAll();
        return $this->render('joueur/listJoueur.html.twig',[
            'list' => $list
        ]);
    }

    #[Route('/deleteJoueur/{id}', name: 'Joueur_delete')]
    public function deleteBook(ManagerRegistry $manager , JoueurRepository $repo, $id):Response{
        $em = $manager->getManager();

        $Joueur = $repo->find($id);

        $em->remove($Joueur);
        $em->flush();
        
        return $this->redirectToRoute('Joueur_list');
    }
}
