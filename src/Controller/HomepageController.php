<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig', ['controller_name'=> 'HomepageController', 'mainNavHome'=>true, 'title'=>'ArnaK.com', 'title2'=>'Le site d\'annonces qui vous dépouille...']);
    }
}
