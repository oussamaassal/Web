<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\JoueurType;
use App\Repository\JoueurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/Roster', name: 'Joueur_list')]
    public function listJoueurs_front(JoueurRepository $repo):Response{

        $list = $repo->findAll();
        return $this->render('joueur/Roster.html.twig',[
            'list' => $list
        ]);
    }

    #[Route('/deleteJoueur/{id}', name: 'Joueur_delete')]
    public function deleteJoueur(ManagerRegistry $manager , JoueurRepository $repo, $id):Response{
        $em = $manager->getManager();

        $Joueur = $repo->find($id);

        $em->remove($Joueur);
        $em->flush();
        
        return $this->redirectToRoute('Joueur_list');
    }

    #[Route('/newJoueur', name: 'Joueur_add')]
    public function addJoueur(Request $req,ManagerRegistry $manager):Response{

        $em = $manager->getManager();

        $Joueur = new Joueur();

        $form = $this->createForm(JoueurType::class,$Joueur);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()) {

                $file = $form['imagepath']->getData();
            if ($file) {
                // Generate a unique name for the file before saving it
                $fileName = $Joueur->getId().$Joueur->getNom().'.'.$file->guessExtension();

                // Move the file to the directory where images are stored
                $file->move(
                    $this->getParameter('joueurs_image_directory'),
                    $fileName
                );
                // Set the image path on the entity
                $Joueur->setImagepath($fileName);
            }
                $em->persist($Joueur);
                $em->flush();

            return $this->redirectToRoute('Joueur_list');
        }
        return $this->renderForm('Joueur/addJoueur.html.twig',[
            'f' => $form
        ]);
    }

    #[Route('/EditJoueur/{id}', name: 'Joueur_edit')]
    public function editJoueur($id, JoueurRepository $repo, Request $req,ManagerRegistry $manager):Response{

        $em = $manager->getManager();

        $Joueur = $repo->find($id);

        $form = $this->createForm(JoueurType::class,$Joueur);
        
        $form->handleRequest($req);
        if($form->isSubmitted()) {
            $em->persist($Joueur);
            $em->flush();
            return $this->redirectToRoute('Joueur_list');
        }
        return $this->renderForm('joueur/updateJoueur.html.twig',[
            'f' => $form
        ]);
    }

    #[Route('/pageJoueur/{id}', name: 'Joueur_page')]
    public function pageJoueur($id, JoueurRepository $repo):Response{

        $Joueur = $repo->find($id);

        return $this->renderForm('joueur/pageJoueur.html.twig',[
            'Joueur' => $Joueur
        ]);
    }
}
