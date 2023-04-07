<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Form\AnnouncementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{
    /**
     * @Route("/annonce/ajouter", name="add_announcement")
     */
    public function addAnnouncement(Request $request): Response
    {
        $announcement = new Announcement();

        $form = $this->createForm(AnnouncementType::class, $announcement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Do something with the submitted data
        }

        return $this->render('announcement/add_announcement.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
