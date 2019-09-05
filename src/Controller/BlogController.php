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
use App\Repository\DesignerRepository;

Use App\Entity\Modele;
Use App\Entity\Brand;
Use App\Entity\Club;
Use App\Entity\Event;
Use App\Entity\Collector;
Use App\Entity\Designer;

use App\Form\ModeleType;
use App\Form\ModeleSearchType;


class BlogController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em) {
      $this->em = $em;
    }

    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        $brands = $this->em->getRepository(Brand::class)->findAll();

        $designers = $this->em->getRepository(Designer::class)->findAll();

        $collectors = $this->em->getRepository(Collector::class)->findAll();

    	return $this->render('blog/home.html.twig', [
            'brands' => $brands,
            'designers' => $designers,
            'collectors' => $collectors
        ]);
    }

    /**
     * @Route("/search/{type}/{criteria}/{search}", name="search")
     *
     */
    public function searchM(Request $request, $search=null, $type=null, $criteria=null) {

        $repository = $this->em->getRepository("App\Entity\\$type");

        if ($criteria != 0 && $type === 'Modele') {
            $test = $this->em->getRepository(Brand::class)->find($criteria);
        } else if ($criteria != 0 && $type === 'Collector') {
            $test = $this->em->getRepository(Collector::class)->find($criteria);
        } else if ($criteria != 0 && $type === 'Designer') {
            $test = $this->em->getRepository(Designer::class)->find($criteria);
        } else {
            $test = null;
        }

        $results = $repository->findByLetters($search, $test);

        return $this->render('blog/type/'.$type.'.html.twig', [
         'results' => $results,
         'type' => $type
       ]);
    }

    /**
     * @Route("/result/{type}/{id}", name="result")
     */
    public function resultM(Request $request, $id, $type) {

      $repository = $this->em->getRepository("App\Entity\\$type");

      $result = $repository->find($id);

      return $this->render('blog/result/'.$type.'.html.twig', [
         'result' => $result
       ]);

    }

}
