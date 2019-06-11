<?php

namespace App\Controller\Admin\Media;

use App\Entity\Media;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaDeleteController extends BaseController
{
    /**
     * @Route("/admin/media/delete/{id}", name="admin_media_delete", methods={"POST"})
     */
    public function remove($id): Response
    {
        $media = $this->getDoctrine()->getRepository(Media::class)->find($id);
        if (empty($media)) {
            return $this->redirectToRoute('admin_media_overview');
        }

        $this->delete($media);

        $this->addFlash('success', 'The file is deleted');
        return $this->redirectToRoute('admin_media_overview');
    }
}
