<?php

namespace App\Controller\Admin\Contact;

use App\Entity\Contact;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactOverviewController extends BaseController
{
    /**
     * @Route("/admin/contacts", name="admin_contact_overview")
     */
    public function contact(): Response
    {
        $contacts = $this->getDoctrine()->getRepository(Contact::class)->findAll();

        return $this->render('admin/contact/overview.html.twig', [
            'contacts' => $contacts,
            'navActive' => 'contacts',
        ]);
    }
}
