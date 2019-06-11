<?php

namespace App\Controller\Website;

use App\Entity\ContentBlock;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;

class IndexController extends BaseController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $blocks = $this->getDoctrine()->getRepository(ContentBlock::class)->findByCodes(['homepage_image', 'homepage_1', 'homepage_2', 'homepage_3', 'homepage_4']);

		return $this->render('website/general/index.html.twig', [
		    'blocks' => $blocks,
            'homepage' => 1,
        ]);
    }
}
