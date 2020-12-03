<?php

namespace App\Controller;

use App\Entity\MailForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/")]
final class DemoController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer
    ) {}

    public function __invoke(Request $request): Response
    {
        $form = $this
            ->createFormBuilder(new MailForm())
            ->add('email', TextType::class, ['required' => false])
            ->add('submit', SubmitType::class)
            ->getForm()
            ->handleRequest($request)
        ;

        $serialized = $form->isSubmitted() && $form->isValid()
            ? $this->serializer->serialize($form->getData(), 'json')
            : 'N/A'
        ;

        return $this->render('demo.html.twig', [
            'form' => $form->createView(),
            'serialized' => $serialized,
        ]);
    }
}
