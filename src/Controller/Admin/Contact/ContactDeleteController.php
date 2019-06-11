<?php

namespace App\Controller\Admin\Contact;

use App\Entity\Contact;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactDeleteController extends BaseController
{
    /**
     * @Route("/admin/contact/delete/{id}", name="admin_contact_delete", methods={"POST"})
     */
    public function remove($id): Response
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);
        if (empty($contact)) {
            return $this->redirectToRoute('admin_contact_overview');
        }

        $this->delete($contact);

        $this->addFlash('success', 'The contact is deleted');
        return $this->redirectToRoute('admin_contact_overview');
    }
}
