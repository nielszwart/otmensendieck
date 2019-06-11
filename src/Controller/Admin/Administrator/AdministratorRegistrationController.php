<?php

namespace App\Controller\Admin\Administrator;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdministratorRegistrationController extends BaseController
{
    /**
     * @Route("/admin/register", name="admin_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(['ROLE_ADMIN']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'New administrator is created');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/administrator/register.html.twig', [
            'form' => $form->createView(),
            'navActive' => 'administrators',
        ]);
    }
}
