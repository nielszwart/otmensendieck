<?php

namespace App\Controller\Admin\ContentBlock;

use App\Entity\ContentBlock;
use App\Controller\BaseController;
use App\Form\ContentBlockFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContentBlockCreateController extends BaseController
{
    /**
     * @Route("/admin/block/new", name="admin_block_create")
     */
    public function create(Request $request): Response
    {
        $block = new ContentBlock();
        $form = $this->createForm(ContentBlockFormType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->save($block);

            $this->addFlash('success', 'Created new content block');
            return $this->redirectToRoute('admin_block_overview');
        }

        return $this->render('admin/block/create.html.twig', [
            'form' => $form->createView(),
            'navActive' => 'blocks',
        ]);
    }
}
