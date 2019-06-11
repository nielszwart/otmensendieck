<?php

namespace App\Controller\Admin\Menu;

use App\Controller\BaseController;
use App\Entity\MenuItem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuItemDeleteController extends BaseController
{
    /**
     * @Route("/admin/menu/item/delete/ajax/{id}", name="admin_menu_item_delete_ajax", methods={"POST"})
     */
    public function ajax($id): Response
    {
        $item = $this->getDoctrine()->getRepository(MenuItem::class)->find($id);
        if (empty($item)) {
            return new JsonResponse('Could not find menu item', 404);
        }

        $this->delete($item);

        return new JsonResponse(true);
    }
}
