<?php

namespace App\Controller\Admin\ContentBlock;

use App\Entity\ContentBlock;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContentBlockOverviewController extends BaseController
{
    /**
     * @Route("/admin/blocks", name="admin_block_overview")
     */
    public function media(): Response
    {
        $blocks = $this->getDoctrine()->getRepository(ContentBlock::class)->findAll();

        return $this->render('admin/block/overview.html.twig', [
            'blocks' => $blocks,
            'navActive' => 'blocks',
        ]);
    }
}
