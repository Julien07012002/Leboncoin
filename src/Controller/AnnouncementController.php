<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Repository\AnnouncementRepository;
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

    /**
     * Toggle the visibility of an announcement.
     *
     * @Route("/announcement/toggle-visibility/{id}", name="announcement_toggle_visibility", methods={"POST"})
     */
    public function toggleVisibility(Request $request, Announcement $announcement): Response
    {
        $announcement->setIsVisible(!$announcement->getIsVisible());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('announcement_detail', ['id' => $announcement->getId()]);
    }

    public function index(AnnouncementRepository $announcementRepository)
    {
    $announcements = $announcementRepository->findByVisible();
    return $this->render('announcement/index.html.twig', [
        'announcements' => $announcements
    ]);
    }

    /**
     * @Route("/announcement/{id}", name="announcement_show")
     */
    public function show(Announcement $announcement): Response
    {
        return $this->render('announcement/show.html.twig', [
            'announcement' => $announcement
        ]);
    }

    /**
     * @Route("/announcement/{id}", name="announcement_detail")
     */
    public function detail(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $announcement = $entityManager->getRepository(Announcement::class)->find($id);

        if (!$announcement) {
            throw $this->createNotFoundException('No announcement found for id ' . $id);
        }

        $commentary = new Commentary();
        $commentaryForm = $this->createForm(CommentaryType::class, $commentary);

        $commentaryForm->handleRequest($request);
        if ($commentaryForm->isSubmitted() && $commentaryForm->isValid()) {
            $commentary->setUser($this->getUser());
            $commentary->setAnnouncement($announcement);
            $entityManager->persist($commentary);
            $entityManager->flush();

            $this->addFlash('success', 'Your comment has been posted successfully.');
            return $this->redirectToRoute('announcement_detail', ['id' => $id]);
        }

        return $this->render('announcement/detail.html.twig', [
            'announcement' => $announcement,
            'commentaryForm' => $commentaryForm->createView(),
        ]);
    }
}
