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
            $this->save($menu, true);

            $menuItems = $request->request->get('menu_items');
            if (is_array($menuItems)) {
                foreach ($menuItems as &$item) {
                    $menuItem = new MenuItem();
                    $menuItem->edit($item);
                    $this->save($menuItem, true);

                    $item['id'] = $menuItem->getId();

                    $menu->addMenuItem($menuItem);
                }
                unset($item);

                foreach ($menuItems as $item) {
                    if (strlen($item['parentId']) > 0) {
                        foreach ($menuItems as $parentItem) {
                            if ($item['parentId'] === $parentItem['tempId']) {
                                $menuItem = $this->getDoctrine()->getRepository(MenuItem::class)->find($item['id']);
                                $parentItemEntity = $this->getDoctrine()->getRepository(MenuItem::class)->find($parentItem['id']);
                                $menuItem->setParent($parentItemEntity);
                                $menuItem->setMenu(null);
                                $this->save($menuItem);
                                break;
                            }
                        }
                    }
                }
            }

            $this->save($menu);

            $this->addFlash('success', 'Created new menu');
            return $this->redirectToRoute('admin_menu_edit', ['id' => $menu->getId()]);
        }

        return $this->render('admin/menu/create.html.twig', [
            'form' => $form->createView(),
            'navActive' => 'menus',
            'menu' => $menu,
            'pages' => $this->getDoctrine()->getRepository(Page::class)->findBy(['active' => true]),
        ]);
    }
}
