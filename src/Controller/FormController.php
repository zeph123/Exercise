<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Code;
use App\Form\CodeType;
use App\Service\CodeValidator;
use App\Repository\CodeRepository;

class FormController extends AbstractController
{

    /**
     * @Route("/form", name="form")
     */

    public function index(Request $request, CodeValidator $validator, CodeRepository $repository): Response
    {

        $code = new Code();

        $form = $this->createForm(CodeType::class, $code);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $code = $form->getData();

            // setting the date of adding the number (code)
            date_default_timezone_set('Europe/Warsaw');
            $code->setAddedDate(new \DateTime());

            // setting the flag - checking if number (code) is correct
            // $validator->validateCode($code->getNumber());
            $code->setIsCorrect($validator->validateCode($code->getNumber()));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($code);
            $entityManager->flush();

            return $this->redirectToRoute('form');
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
            'codes' => $repository->sortByDateDescending(),
        ]);

    }

}
