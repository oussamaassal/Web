<?php

namespace App\Controller;

use App\Entity\ReserverTerrain;
use App\Entity\Terrain;
use App\Form\ReserverTerrainType;
use App\Form\TerrainType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ReserverterrainController extends AbstractController
{

    #[Route('/reserverterrain', name: 'reserverterrain')]
    public function index(Request $request): Response
    {
        $terrain = new ReserverTerrain();
        $form = $this->createForm(ReserverTerrainType::class,$terrain) ;
        $form->handleRequest($request);
        if ($form -> isSubmitted() && $form->isValid()){
            $en = $this->getDoctrine()->getManager();
            $en->persist($terrain);
            $en->flush();
            return $this->redirectToRoute('app_reservation'); // thezni lel page /terrain itha mrigel
        }
        return $this->render('/reserverterrain/index.html.twig',['f'=>$form->createView()]);
    }
}