<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Dompdf\Dompdf;
use Dompdf\Options;


#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    #[Route('/front', name: 'front', methods: ['GET'])]
    public function front(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findEvenementsAujourdhui();

        return $this->render('evenement/evenement.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    #[Route('/eventcalendrier', name: 'app_rdv')]
    public function calendrierrdv(EvenementRepository $evenementRepository): Response
    {
        $events = $evenementRepository->findAll();
        $rdvs = [];
        foreach ($events as $event) {
            $startDateTime = $event->getDateE()->format('Y-m-d') ;

            $rdvs[] = [
                'id' => $event->getIde(),
                'title' => $event->getNomE(),
                'start' =>$startDateTime
                
            ];
        }
        $rdvsJson = json_encode($rdvs);

    // Pass the JSON data to the Twig template
    return $this->render('evenement/calendar.html.twig', compact('rdvsJson'));

    }

   
    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
    
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $file = $form->get('imgepath')->getData();
    
            if ($file) {
                // Specify the upload directory path directly
                $uploadDirectory = $this->getParameter('kernel.project_dir') . '/public/uploads';
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($uploadDirectory, $fileName);
                $evenement->setImgepath($fileName);
            }
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();
    
    
          
    
            return $this->redirectToRoute('send_sms');
                }
    
        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/pdfGenerator', name: 'app_evenement_pdf',methods: ['GET', 'POST'])]
    public function exportPdf(EvenementRepository $evenementRepository): Response
    {
        $evenements=$evenementRepository->findAll();
        $html = $this->renderView('evenement/pdf.html.twig', ['evenements' => $evenements]);
    
        // Set up Dompdf options and render the PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        
        $dompdf = new Dompdf();
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->render();
        
        // Return the PDF as a response
        return new Response(
            $dompdf->output(),
            Response::HTTP_OK,
            ['Content-Type' => 'application/pdf']
        );
    }

    #[Route('/{ide}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIde(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{ide}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imgepath')->getData();

            if ($file) {
                // Specify the upload directory path directly
                $uploadDirectory = $this->getParameter('kernel.project_dir') . '/public/uploads';
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($uploadDirectory, $fileName);
                $evenement->setImgepath($fileName);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }
    
    
}