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

class MenuEditController extends BaseController
{
    /**
     * @Route("/admin/menu/edit/{id}", name="admin_menu_edit")
     */
    public function create($id, Request $request): Response
    {
        $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id);
        $form = $this->createForm(MenuFormType::class, $menu, ['is_edit' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuItems = $request->request->get('menu_items');
            if (is_array($menuItems)) {
                foreach ($menuItems as $item) {
                    if (!empty($item['id'])) {
                        $menuItem = $this->getDoctrine()->getRepository(MenuItem::class)->find($item['id']);
                    } else {
                        $menuItem = new MenuItem();
                    }

                    $menuItem->edit($item);
                    $menu->addMenuItem($menuItem);
                }
            }

            $this->save($menu);

            $this->addFlash('success', 'Your changes have been saved!');
            return $this->redirectToRoute('admin_menu_edit', ['id' => $menu->getId()]);
        }

        return $this->render('admin/menu/edit.html.twig', [
            'form' => $form->createView(),
            'menu' => $menu,
            'navActive' => 'menus',
            'edit' => true,
            'pages' => $this->getDoctrine()->getRepository(Page::class)->findBy(['active' => true]),
        ]);
    }
}
