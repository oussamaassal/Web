<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContratController extends AbstractController
{
    #[Route('/Contrat', name: 'app_Contrat')]
    public function index(): Response
    {
        return $this->render('list.html.twig', [
            'controller_name' => 'ContratController',
        ]);
    }

    #[Route('/getContrats', name: 'Contrat_list')]
    public function listContrats(ContratRepository $repo):Response{

        $list = $repo->findAll();
        return $this->render('contrat/listContrat.html.twig',[
            'list' => $list
        ]);
    }

    #[Route('/deleteContrat/{id}', name: 'Contrat_delete')]
    public function deleteContrat(ManagerRegistry $manager , ContratRepository $repo, $id):Response{
        $em = $manager->getManager();

        $Contrat = $repo->find($id);

        $em->remove($Contrat);
        $em->flush();
        
        return $this->redirectToRoute('Contrat_list');
    }

    #[Route('/newContrat', name: 'Contrat_add')]
    public function addContrat(Request $req,ManagerRegistry $manager):Response{

        $em = $manager->getManager();

        $Contrat = new Contrat();

        $form = $this->createForm(ContratType::class,$Contrat);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()) {
                $em->persist($Contrat);
                $em->flush();

            return $this->redirectToRoute('Contrat_list');
        }
        return $this->renderForm('contrat/addContrat.html.twig',[
            'f' => $form
        ]);
    }

    #[Route('/EditContrat/{id}', name: 'Contrat_edit')]
    public function editContrat($id, ContratRepository $repo, Request $req,ManagerRegistry $manager):Response{

        $em = $manager->getManager();

        $Contrat = $repo->find($id);

        $form = $this->createForm(ContratType::class,$Contrat);
        
        $form->handleRequest($req);
        if($form->isSubmitted()) {
            $em->persist($Contrat);
            $em->flush();
            return $this->redirectToRoute('Contrat_list');
        }
        return $this->renderForm('Contrat/updateContrat.html.twig',[
            'f' => $form
        ]);
    }
}
