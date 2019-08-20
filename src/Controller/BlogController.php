<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

use App\Repository\ModeleRepository;
use App\Repository\ClubRepository;
use App\Repository\EventRepository;
use App\Repository\CollectorRepository;

Use App\Entity\Modele;
Use App\Entity\Club;
Use App\Entity\Event;
Use App\Entity\Collector;
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
     * @Route("/search/{type}/{search}", name="search")
     *
     */
    public function searchM(Request $request, EntityManagerInterface $em, $search=null, $type=null) {

        if( $type === 'Club') {
          $repository = $em->getRepository(Club::class);
        } elseif( $type === 'Event') {
          $repository = $em->getRepository(Event::class);
        } elseif( $type === 'Modele') {
          $repository = $em->getRepository(Modele::class);
        } elseif( $type === 'Collector') {
          $repository = $em->getRepository(Collector::class);
        }

        $results = $repository->findByLetters($search);

        return $this->render('blog/results.html.twig', [
         'results' => $results,
         'type' => $type
       ]);
    }

    /**
     * @Route("/result/{id}", name="result")
     *
     */
    public function resultM(Request $request, ModeleRepository $repo, Modele $modele) {

      $id = $request->get('id');
      $result = $repo->find($id);

      return $this->render('blog/searchResult.html.twig', [
         'result' => $result
       ]);

    }

}
