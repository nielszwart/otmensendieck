<?php

namespace App\Controller;

use App\Entity\ContentBlock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
	public function save($entity, $refresh = false)
	{
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($entity);
        $entityManager->flush();

        if ($refresh) {
            $entityManager->refresh($entity);
        }
	}

	public function delete($entity)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($entity);
		$entityManager->flush();
	}

	public function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $globalBlocks = $this->getDoctrine()->getRepository(ContentBlock::class)->findByCodes(['footer']);
        if (!empty($parameters['blocks'])) {
            $parameters['blocks'] = array_merge($parameters['blocks'], $globalBlocks);
        } else {
            $parameters['blocks'] = $globalBlocks;
        }

        return parent::render($view, $parameters, $response);
    }
}
