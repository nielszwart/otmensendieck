<?php

namespace App\Controller\Admin\Media;

use App\Entity\Media;
use App\Controller\BaseController;
use App\Form\MediaFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MediaCreateController extends BaseController
{
    /**
     * @Route("/admin/media/new", name="admin_media_create")
     */
    public function create(Request $request): Response
    {
        $media = new Media();
        $form = $this->createForm(MediaFormType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->save($media);

            $this->addFlash('success', 'Uploaded new media');
            return $this->redirectToRoute('admin_media_overview');
        }

        return $this->render('admin/media/create.html.twig', [
            'form' => $form->createView(),
            'navActive' => 'media',
        ]);
    }
}
