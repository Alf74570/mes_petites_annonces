<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Ad;
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

        return $this->render('homepage/index.html.twig', [
            'ads' => $ads,
            'title'=>'ArnaK.com',
            'title2'=>'Le site d\'annonces qui vous dépouille...']);
    }

    /**
     * @Route("/ad_detail/{ad}", name="ad_detail")
     */

    public function showAdDetails(Ad $ad): Response
    {
        $person = $this->getUser();

        return $this->render('homepage/ad_detail.html.twig', [
            'ad'=> $ad ,
            'person' => $person ,
            'title'=>'ArnaK.com',
            'title2'=>'Le site d\'annonces qui vous dépouille...'
        ]);
    }
}

