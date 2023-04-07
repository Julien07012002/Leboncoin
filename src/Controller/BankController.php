<?php

/**
 * @Route("/add-amount", name="add_amount")
 * @IsGranted("ROLE_USER")
 */
public function addAmount(Request $request, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(AddAmountType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $amount = $form->get('amount')->getData();

        $user = $this->getUser();
        $bank = $user->getBank();
        $balance = $bank->getBalance();

        $newBalance = $balance + $amount;

        $bank->setBalance($newBalance);

        $entityManager->persist($bank);
        $entityManager->flush();

        $this->addFlash('success', 'Amount added successfully');

        return $this->redirectToRoute('dashboard');
    }

    return $this->render('bank/add_amount.html.twig', [
        'form' => $form->createView(),
    ]);
}
