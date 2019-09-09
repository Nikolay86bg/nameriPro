<?php

namespace App\Controller;

use App\Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("", name="dashboard", methods="GET")
     */
    public function index()
    {
//        $paginator = (new Paginator($industryRepository->getListQuery('name')))->paginate($request->get('page', 1));
//
//        return $this->render('industry/index.html.twig', [
//            'paginator' => $paginator,
//        ]);

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
