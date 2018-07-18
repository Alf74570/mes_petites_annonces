<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Person;


class PersonController extends Controller
{
    /**
     * @Route("/person", name="person")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $person = new Person();
        $person->setFirstname('Alexandre');
        $person->setLastname('Biagi');
        $person->setEmail('a.bipppakkgi@orange.fr');
        $person->setPhonenumber('06.35.41oooo.44.76');
        $person->setPassword('aze');
        $person->setUsername('Alf74');

        $entityManager->persist($person);

        $entityManager->flush();


        return new Response('Nouvel utilisateur avec l\'id ' .$person->getId(). ' a été enregistré');
    }
}
