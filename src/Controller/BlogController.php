<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Doctrine\Common\Persistence\ObjectManager;

Use App\Entity\Modele;
use App\Form\ModeleType;
use App\Form\ModeleSearchType;


class BlogController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */

    public function home()
    {
    	return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/search", name="searchForm")
     */

    public function searchForm(Request $request) {

      $route = $request->get('customRadio');

      $form = $this->createForm(ModeleSearchType::class);

      if ($route != '') {

        $routeT = 'blog/'.$route.'.html.twig';
        return $this->render($routeT, [
          $route => $form->createView()
        ]);
      } else {
        return $this->redirectToRoute('home');
      }
      //Switch depending on route value calling appropriate service



    }



}
