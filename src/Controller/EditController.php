<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormTypeInterface;

use Doctrine\Common\Persistence\ObjectManager;

use App\Repository\ModeleRepository;
use App\Repository\BrandRepository;
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

Use App\Form\ModeleType;
Use App\Form\BrandType;
Use App\Form\ClubType;
Use App\Form\EventType;
Use App\Form\CollectorType;
Use App\Form\DesignerType;

/**
* @Route("/edit")
*/
class EditController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {

        $this->em = $em;

    }

    /**
     * @Route("/", name="edit")
     *
     */
    public function editHome() {

        return $this->render('edit/type/home.html.twig');

    }

    /**
     * @Route("/Brand/", name="edit_modele")
     */
    public function editModele(Modele $modele = null, Request $request, ObjectManager $manager) {

        $modele = new Modele();

        $form = $this->createForm(ModeleType::class, $modele);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modele);
            $entityManager->flush();

            return $this->redirectToRoute('edit');
        }

            return $this->render('edit/type/Brand/show.html.twig', [
            'formModele' => $form->createView()
        ]);
    }

    /**
     * @Route("/Designer/", name="edit_designer")
     */
    public function editDesigner(Designer $designer = null, Request $request, ObjectManager $manager, $type = null) {


        $designer = new Designer();

        $form = $this->createForm(DesignerType::class, $designer);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($designer);
            $entityManager->flush();

            return $this->redirectToRoute('edit');
        }

            return $this->render('edit/type/Designer/show.html.twig', [
            'formDesigner' => $form->createView()
        ]);
    }


}
