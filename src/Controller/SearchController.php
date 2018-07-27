<?php

namespace App\Controller;

use App\Repository\AdRepository;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchController extends Controller
{
    /**
     * @Route("/search", name="search" , methods="POST")
     */
    public function search(Request $request, AdRepository $adRepository)
    {
        $search = $request->request->get('search');

        $ads = $adRepository->findByKeyword($search);

        return $this->render('search/index.html.twig', [
            'ads' => $ads,
            'title' => 'ArnaK.com',
            'title2' => 'Le site d\'annonces qui vous dépouille...'
        ]);
    }

    /**
     * @Route("/advanced_search", name="recherche_avancee", methods="POST")
     */
    public function advancedSearch(Request $request, AdRepository $adsRepository)
    {

        $search = $request->request->get('advanced_search');

        $ads = $adsRepository->findByCategoryCountryTitleUsername($search);

        return $this->render('search/advanced_search.html.twig', [
            'ads' => $ads,
            'title' => 'ArnaK.com',
            'title2' => 'Le site d\'annonces qui vous dépouille...'
        ]);

    }

    /**
     * @Route("/advanced_search_view", name="vue_recherche_avancee")
     */
    public function showAdvancedSearchView(Request $request)
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);


        return $this->render('search/advanced_search_view.html.twig', [
            'form' => $form->createView(),
            'title' => 'ArnaK.com',
            'title2' => 'Le site d\'annonces qui vous dépouille...'
        ]);

    }

    public function countrySelect()
    {
        $response = json_decode(file_get_contents('https://geo.api.gouv.fr/regions?fields=nom'), true);
        $myRegions = array_map(function ($el) {
            return $el['nom'];
        }, $response);

    }
}