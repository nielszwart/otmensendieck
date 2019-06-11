<?php

namespace App\Controller\Admin\Contact;

use App\Entity\Contact;
use App\Controller\BaseController;
use App\Form\ContactFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactViewController extends BaseController
{
    /**
     * @Route("/admin/contact/{id}", name="admin_contact_view")
     */
    public function create($id): Response
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);
        $form = $this->createForm(ContactFormType::class, $contact);

        return $this->render('admin/contact/view.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact,
            'navActive' => 'contacts',
        ]);
    }
}
