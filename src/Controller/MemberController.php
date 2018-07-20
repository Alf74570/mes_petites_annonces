<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/member")
 */
class MemberController extends Controller
{
        /**
         * @Route("/", name= "member")
         */
        public function index() {
        return $this->render('member/index.html.twig', ['controller_name'=>'MemberController', 'mainNavMember'=>true, 'title'=>'Espace Membre']);
    }
}
