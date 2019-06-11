<?php

namespace App\Controller\Admin\Page;

use App\Entity\Page;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageOverviewController extends BaseController
{
    /**
     * @Route("/admin/pages", name="admin_page_overview")
     */
    public function pages(): Response
    {
        $pages = $this->getDoctrine()->getRepository(Page::class)->findAll();

        return $this->render('admin/page/overview.html.twig', [
            'pages' => $pages,
            'navActive' => 'pages',
        ]);
    }
}
