<?php

namespace App\Controller\Admin\ContentBlock;

use App\Entity\ContentBlock;
use App\Controller\BaseController;
use App\Form\ContentBlockFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContentBlockEditController extends BaseController
{
    /**
     * @Route("/admin/block/edit/{id}", name="admin_block_edit")
     */
    public function create($id, Request $request): Response
    {
        $block = $this->getDoctrine()->getRepository(ContentBlock::class)->find($id);
        $form = $this->createForm(ContentBlockFormType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->save($block);

            $this->addFlash('success', 'Your changes have been saved!');
            return $this->redirectToRoute('admin_block_edit', ['id' => $block->getId()]);
        }

        return $this->render('admin/block/edit.html.twig', [
            'form' => $form->createView(),
            'block' => $block,
            'navActive' => 'blocks',
            'edit' => true,
        ]);
    }
}
