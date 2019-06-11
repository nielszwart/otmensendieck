<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\BaseController;

class AdminDashboardController extends BaseController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function dashboard()
    {
		return $this->render('admin/general/dashboard.html.twig', [
            'navActive' => 'dashboard',
        ]);
    }
}