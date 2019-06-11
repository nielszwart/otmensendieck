<?php

namespace App\Controller\Admin\Page;

use App\Entity\Page;
use App\Controller\BaseController;
use App\Form\PageFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PageCreateController extends BaseController
{
    /**
     * @Route("/admin/page/new", name="admin_page_create")
     */
    public function create(Request $request): Response
    {
        $page = new Page();
        $form = $this->createForm(PageFormType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();
            $entityManager->refresh($page);

            $this->addFlash('success', 'The new page is created');
            return $this->redirectToRoute('admin_page_edit', ['id' => $page->getId()]);
        }

        return $this->render('admin/page/create.html.twig', [
            'form' => $form->createView(),
            'navActive' => 'pages',
        ]);
    }
}
