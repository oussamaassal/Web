<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeTerrainController extends AbstractController
{
    #[Route('/testterrain', name: 'app_liste_terrain')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'ListeTerrainController',
        ]);
    }




}
