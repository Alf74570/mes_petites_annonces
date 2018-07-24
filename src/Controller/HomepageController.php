<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\AdRepository;
use App\Repository\PersonRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function showAllAds(AdRepository $ad): Response
    {
       $ads = $ad->findAll();

        return $this->render('homepage/index.html.twig', ['ads' => $ads, 'title'=>'ArnaK.com', 'title2'=>'Le site d\'annonces qui vous dépouille...']);
    }


}

