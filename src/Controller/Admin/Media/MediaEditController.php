<?php

namespace App\Controller\Admin\Media;

use App\Entity\Media;
use App\Controller\BaseController;
use App\Form\MediaFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MediaEditController extends BaseController
{
    /**
     * @Route("/admin/media/edit/{id}", name="admin_media_edit")
     */
    public function create($id, Request $request): Response
    {
        $media = $this->getDoctrine()->getRepository(Media::class)->find($id);
        $form = $this->createForm(MediaFormType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->save($media);

            $this->addFlash('success', 'Your changes have been saved!');
            return $this->redirectToRoute('admin_media_edit', ['id' => $media->getId()]);
        }

        return $this->render('admin/media/edit.html.twig', [
            'form' => $form->createView(),
            'media' => $media,
            'navActive' => 'media',
            'edit' => true,
        ]);
    }
}
