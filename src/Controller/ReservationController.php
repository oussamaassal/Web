<?php

namespace App\Controller;
use App\Entity\Terrain;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(): Response
    {
        $terrains = $this->getDoctrine()->getManager()->getRepository(Terrain::class)->findAll();

        return $this->render('reservation/reservation.html.twig', [
            'b'=>$terrains
        ]);
    }


}
