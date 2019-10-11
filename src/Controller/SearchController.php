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

/**
 * @Route("/search")
 */
class SearchController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {

        $this->em = $em;

    }

    /**
     * @Route("/", name="search")
     *
     */
    public function search() {

        return $this->render('search/type/home.html.twig');

    }


    /**
     * @Route("/{type}", name="search_primary")
     *
     */
    public function searchByType(Request $request, $type=null) {

        $repository = $this->em->getRepository("App\Entity\\$type");
        $results = $repository->findAll();

        return $this->render('search/type/'.$type.'/list.html.twig', [
            'results' => $results,
            'type' => $type
        ]);
    }

    /**
     * @Route("/{type}/{primary}", name="search_secondary")
     *
     */
    public function searchByPrimary(Request $request, $type=null, $primary=null) {

        $repository = $this->em->getRepository("App\Entity\\$type");

        $results = $repository->findOneBy(array('id' => $primary));


        return $this->render('search/type/'.$type.'/options.html.twig', [
            'results' => $results,
            'type' => $type
        ]);
    }

    /**
     * @Route("/result/{type}/{primary}/{secondary}", name="search_result")
     *
     */
    public function searchBySecondary(Request $request, $type=null, $primary=null, $secondary=null) {

        $repository = $this->em->getRepository("App\Entity\\$type");
        $result = $repository->findWithPandS($primary, $secondary);

        return $this->render('search/type/'.$type.'/result.html.twig', [
                'result' => $result,
                'type' => $type,
                'secondary' => $secondary
            ]);
    }

    /**
     * @Route("/numbers/{criteria}/{myString}", name="search_result_numbers")
     *
     */
    public function searchByNumbers(Request $request, $criteria=null, $myString=null) {

        $repository = $this->em->getRepository("App\Entity\Modele");
        $result = $repository->findWithNumber($criteria, $myString);

        return $this->render('search/type/Modele/result.html.twig', [
                'result' => $result
            ]);
    }
}
