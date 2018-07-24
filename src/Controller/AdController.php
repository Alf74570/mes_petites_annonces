<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\AdRepository;
use App\Entity\Ad;
use App\Form\AdType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class AdController extends Controller
{
    public function index(AdRepository $adRepository)
    {
        $person = $this->getUser();
        return $this->render('ad/index.html.twig', [
            'ads' => $adRepository->findAll(),
            'person' => $person
        ]);
    }

    /**
     * @Route("/ad_new", name="ad_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $ad = new Ad();
        $person = $this->getUser();
        $ad->setAuthor($person);
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            dump($ad);
            $em->persist($ad);
            $em->flush();
            $this->addFlash('success', 'Votre annonce a bien été enregistrée.');
            return $this->redirectToRoute('account');
        }
        return $this->render('ad/index.html.twig', [
            'form' => $form->createView(), 'mainNavAd' => true, 'title'=>'ArnaK.com', 'title2'=>'Le site d\'annonces qui vous dépouille...'
        ]);
    }

    /**
     * @Route("/show/{ad}", name="ad_show")
     */
    public function show(Ad $ad)
    {
        $person = $this -> getUser();

        return $this->render('ad/show.html.twig', ['ad' => $ad, 'person' => $person, 'title'=>'ArnaK.com', 'title2'=>'Le site d\'annonces qui vous dépouille...']);
    }

    /**
     * @Route("/delete/{ad}", name="ad_delete", methods="DELETE")
     */
    public function delete(Request $request, Ad $ad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ad->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ad);
            $em->flush();
        }
        return $this->redirectToRoute('mes_annonces');
    }

    /**
     * @Route("/edit/{ad}", name="ad_edit", methods="GET|POST")
     */
    public function edit(Request $request, Ad $ad, AuthorizationCheckerInterface $authChecker): Response
    {
        $em = $this->getDoctrine()->getManager();

        if (!$authChecker->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $person = $this->getUser();

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Votre annonce a bien été modifiée');
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }
        return $this->render('ad/edit.html.twig', [
            'ads' => $ad,
            'person' => $person,
            'form' => $form->createView(), 'title'=>'ArnaK.com', 'title2'=>'Le site d\'annonces qui vous dépouille...'
        ]);
    }
}
