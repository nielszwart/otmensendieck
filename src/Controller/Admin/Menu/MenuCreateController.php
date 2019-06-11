<?php

namespace App\Controller\Admin\Menu;

use App\Controller\BaseController;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Page;
use App\Form\MenuFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MenuCreateController extends BaseController
{
    /**
     * @Route("/admin/menu/new", name="admin_menu_create")
     */
    public function create(Request $request): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuFormType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuItems = $request->request->get('menu_items');
            if (is_array($menuItems)) {
                foreach ($menuItems as $item) {
                    $menuItem = new MenuItem();
                    $menuItem->edit($item);
                    $menu->addMenuItem($menuItem);
                }
            }

            $this->save($menu);

            $this->addFlash('success', 'Created new menu');
            return $this->redirectToRoute('admin_menu_overview');
        }

        return $this->render('admin/menu/create.html.twig', [
            'form' => $form->createView(),
            'navActive' => 'menus',
            'menu' => $menu,
            'pages' => $this->getDoctrine()->getRepository(Page::class)->findBy(['active' => true]),
        ]);
    }
}
