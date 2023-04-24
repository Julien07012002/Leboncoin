<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AddressController extends AbstractController
{
    /**
     * @Route("/address/new", name="address_new")
     */
    public function new(Request $request)
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($address);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('address/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
 * @Route("/admin/address/{id}/edit", name="admin_address_edit")
 */
  public function edit(Request $request, Address $address): Response
  {
    $form = $this->createForm(AddressType::class, $address);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_user_edit', ['id' => $address->getUser()->getId()]);
    }

    return $this->render('admin/address/edit.html.twig', [
        'form' => $form->createView(),
        'address' => $address,
    ]);
  }

  /**
 * @Route("/delete-address/{id}", name="delete_address")
 */
public function deleteAddress(Request $request, int $id)
{
    $entityManager = $this->getDoctrine()->getManager();
    $address = $entityManager->getRepository(Address::class)->find($id);

    if (!$address) {
        throw $this->createNotFoundException('Address not found');
    }

    $entityManager->remove($address);
    $entityManager->flush();

    $this->addFlash('success', 'Address deleted successfully');

    return $this->redirectToRoute('backoffice_address');
}
}