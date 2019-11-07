<?php

namespace App\Controller\Website\Page;

use App\Controller\BaseController;
use App\Entity\Contact;
use App\Entity\Menu;
use App\Entity\Page;
use App\Entity\Signup;
use App\Form\ContactFormType;
use App\Form\SignupFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class PageViewController extends BaseController
{
    /**
     * @Route("/{slug}", name="page_view")
     */
    public function page($slug, Request $request)
    {
        $page = $this->getDoctrine()->getRepository(Page::class)->findOneBy(['slug' => $slug]);
        if (empty($page)) {
            throw new HttpException(404, 'Page could not be found');
        }

        if ($page->getCode() === 'contact') {
            $contact = new Contact();
            $form = $this->createForm(ContactFormType::class, $contact);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if (!empty($request->request->get('contact_form_email_check'))) {
                    return $this->redirectToRoute('index');
                }

                $this->save($contact);

                $this->addFlash('success', 'Uw bericht is verstuurd!');
                return $this->redirectToRoute('page_view', ['slug' => $page->getSlug()]);
            }
        }

        if ($page->getCode() === 'inschrijven') {
            $signup = new Signup();
            $form = $this->createForm(SignupFormType::class, $signup);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if (!empty($request->request->get('signup_form_email_check'))) {
                    return $this->redirectToRoute('index');
                }

                $this->save($signup);

                $this->addFlash('success', 'Uw inschrijving is verstuurd!');
                return $this->redirectToRoute('page_view', ['slug' => $page->getSlug()]);
            }
        }

        return $this->render('website/page/view.html.twig', [
            'page' => $page,
            'form' => isset($form) ? $form->createView() : null,
        ]);
    }
}
