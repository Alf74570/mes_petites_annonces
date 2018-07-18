<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use function Sodium\add;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class FormController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function new(Request $request)
    {
        $person = new Person();

        $form = $this->createForm(PersonType::class, $person);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($person);
                    $em->flush();

                    return $this->redirectToRoute('inscription', array('id' => $person->getId()));
        }

        return $this->render('form/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
