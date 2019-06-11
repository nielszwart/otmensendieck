<?php

namespace App\Controller\Website\Page;

use App\Controller\BaseController;
use App\Entity\Page;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class PageViewController extends BaseController
{
    /**
     * @Route("/{slug}", name="page_view")
     */
    public function page($slug)
    {
        $page = $this->getDoctrine()->getRepository(Page::class)->findOneBy(['slug' => $slug]);
        if (empty($page)) {
            throw new HttpException(404, 'Page could not be found');
        }

        return $this->render('website/page/view.html.twig', [
            'page' => $page,
        ]);
    }
}
