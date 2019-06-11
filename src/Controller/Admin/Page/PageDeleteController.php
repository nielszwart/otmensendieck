<?php

namespace App\Controller\Admin\Page;

use App\Entity\Page;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageDeleteController extends BaseController
{
    /**
     * @Route("/admin/page/delete/{id}", name="admin_page_delete", methods={"POST"})
     */
    public function create($id): Response
    {
        $page = $this->getDoctrine()->getRepository(Page::class)->find($id);
        if (empty($page)) {
            return $this->redirectToRoute('admin_page_overview');
        }

        $this->delete($page);

        $this->addFlash('success', 'The page is deleted');
        return $this->redirectToRoute('admin_page_overview');
    }
}
