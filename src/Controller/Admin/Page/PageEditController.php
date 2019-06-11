<?php

namespace App\Controller\Admin\Page;

use App\Entity\Page;
use App\Controller\BaseController;
use App\Form\PageFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PageEditController extends BaseController
{
    /**
     * @Route("/admin/page/edit/{id}", name="admin_page_edit")
     */
    public function create($id, Request $request): Response
    {
        $page = $this->getDoctrine()->getRepository(Page::class)->find($id);
        $form = $this->createForm(PageFormType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->save($page);

            $this->addFlash('success', 'Your changes have been saved');
            return $this->redirectToRoute('admin_page_edit', ['id' => $page->getId()]);
        }

        return $this->render('admin/page/edit.html.twig', [
            'form' => $form->createView(),
            'page' => $page,
            'navActive' => 'pages',
            'edit' => true,
        ]);
    }
}
