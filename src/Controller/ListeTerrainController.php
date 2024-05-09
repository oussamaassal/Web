<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CategTerrain;
use App\Form\CategTerrainType;
use App\Entity\Terrain;

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
