<?php
// Set the locale to French
namespace App\Controller;

use App\Entity\Terrain;
use App\Form\TerrainType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerrainController extends AbstractController
{
    #[Route('/listeterrain', name: 'app_terrain')]
    public function index(): Response
    {
        $terrains = $this->getDoctrine()->getManager()->getRepository(Terrain::class)->findAll();

        return $this->render('terrain/index.html.twig', [
            'b'=>$terrains
        ]);
    }

    #[Route('/addTerrain', name: 'addTerrain')]
    public function addTerrain(Request $request): Response
    {
        $terrain = new Terrain() ;
        $form = $this->createForm(TerrainType::class,$terrain) ;
        $form->handleRequest($request);
        if ($form -> isSubmitted() && $form->isValid()){
            $en = $this->getDoctrine()->getManager();
            $en->persist($terrain);
            $en->flush();

            return $this->redirectToRoute('app_terrain'); // thezni lel page /terrain itha mrigel
        }
        return $this->render('terrain/createTerrain.html.twig',['f'=>$form->createView()]);
    }

    #[Route('/deleteTerrain/{id}', name: 'deleteTerrain')]
    public function deleteTerrain(Terrain $terrain): Response
    {
        $en = $this->getDoctrine()->getManager();
        $en->remove($terrain);
        $en->flush();

        return $this->redirectToRoute('app_terrain') ;
    }


    #[Route('/modifTerrain/{id}', name: 'modifTerrain')]
    public function modifTerrain(Request $request,$id): Response
    {
        $terrain = $this->getDoctrine()->getManager()->getRepository(Terrain::class)->find($id) ;
        $form = $this->createForm(TerrainType::class,$terrain) ;
        $form->handleRequest($request);
        if ($form -> isSubmitted() && $form->isValid()){
            $en = $this->getDoctrine()->getManager();
            $en->flush();

            return $this->redirectToRoute('app_terrain'); // thezni lel page /terrain itha mrigel
        }
        return $this->render('terrain/updateTerrain.html.twig',['f'=>$form->createView()]);
    }



}
