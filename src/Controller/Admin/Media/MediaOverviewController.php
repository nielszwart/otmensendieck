<?php

namespace App\Controller\Admin\Media;

use App\Entity\Media;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaOverviewController extends BaseController
{
    /**
     * @Route("/admin/media", name="admin_media_overview")
     */
    public function media(): Response
    {
        $media = $this->getDoctrine()->getRepository(Media::class)->findAll();

        return $this->render('admin/media/overview.html.twig', [
            'media' => $media,
            'navActive' => 'media',
        ]);
    }
}
