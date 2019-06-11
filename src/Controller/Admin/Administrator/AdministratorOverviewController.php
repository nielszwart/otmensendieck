<?php

namespace App\Controller\Admin\Administrator;

use App\Entity\User;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministratorOverviewController extends BaseController
{
    /**
     * @Route("/admin/administrators", name="admin_administrator_overview")
     */
    public function administrators(): Response
    {
        $admins = $this->getDoctrine()->getRepository(User::class)->findByRole('ROLE_ADMIN');

        return $this->render('admin/administrator/overview.html.twig', [
            'admins' => $admins,
            'navActive' => 'administrators',
        ]);
    }
}
