<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;



/**
 * @Route("/")
 */


class BlogController extends AbstractController
{
  /**
   * @Route("/", name="home")
   */

  public function home()
  {
  	return $this->render('blog/home.html.twig');
  }
}
