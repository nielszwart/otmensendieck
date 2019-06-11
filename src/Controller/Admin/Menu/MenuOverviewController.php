<?php

namespace App\Controller\Admin\Menu;

use App\Entity\Menu;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuOverviewController extends BaseController
{
    /**
     * @Route("/admin/menus", name="admin_menu_overview")
     */
    public function menus(): Response
    {
        $menus = $this->getDoctrine()->getRepository(Menu::class)->findAll();

        return $this->render('admin/menu/overview.html.twig', [
            'menus' => $menus,
            'navActive' => 'menus',
        ]);
    }
}
