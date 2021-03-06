<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\RegistrationType;
use App\Entity\User;

class SecurityController extends AbstractController
{

//     /**
//     * @Route("/registration", name="app_register")
//     */
//     public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {

//         $user = new User();

//         $form = $this->createForm(RegistrationType::class, $user);

//         $form->handleRequest($request);

//         if($form->isSubmitted() && $form->isValid()) {
//             $hash = $encoder->encodePassword($user, $user->getPassword());

//             $user->setPassword($hash);

//             $manager->persist($user);
//             $manager->flush();

//             return $this->redirectToRoute('app_login');
//         }

//         return $this->render('security/registration.html.twig', [
//           'form' => $form->createView()
//         ]);
//     }*/
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //    $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
