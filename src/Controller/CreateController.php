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

use Symfony\Component\HttpFoundation\Response;

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
Use App\Entity\Contact;
Use App\Entity\Address;
Use App\Entity\Media;



Use App\Form\ModeleType;
Use App\Form\BrandType;
Use App\Form\ClubType;
Use App\Form\EventType;
Use App\Form\CollectorType;
Use App\Form\DesignerType;
Use App\Form\ContactType;
Use App\Form\AddressType;
Use App\Form\MediaType;


/**
* @Route("/create")
*/
class CreateController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {

        $this->em = $em;

    }

    /**
     * @Route("/", name="create")
     *
     */
    public function createHome() {

        return $this->render('create/type/home.html.twig');

    }

    /**
     * @Route("/Brand/{from}", name="create_brand")
     */
    public function createBrand(Brand $brand = null, Request $request, ObjectManager $manager, $from = null) {

        $brand = new Brand();

        $form = $this->createForm(BrandType::class, $brand);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brand);
            $entityManager->flush();

            $id = $brand->getId();

            if ($from == 'Js') {
                return new Response($id);
            } else {
                return $this->redirectToRoute('create');
            }
        }

            return $this->render('create/type/Brand/show.html.twig', [
            'formBrand' => $form->createView()
        ]);
    }

    /**
     * @Route("/Modele/", name="create_modele")
     */
    public function createModele(Modele $modele = null, Request $request, ObjectManager $manager) {

        $entityManager = $this->getDoctrine()->getManager();

        $modele = new Modele();

        $repository = $entityManager->getRepository(Modele::class);

        $modele = $repository->find(5);

        $form = $this->createForm(ModeleType::class, $modele);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Designer

                $temp = explode(',', $request->get('DesAddId'));
                $length =  count($temp);

                for ($i=1; $i < $length; $i++) {

                    if ($temp[$i] != '') {
                        $results = new Designer();
                        $results = $this->em->getRepository(Designer::class)->findOneBy(array('id' => $temp[$i]));
                        $modele->addDesigner($results);
                    }
                }

            //Collector
                $temp2 = explode(',', $request->get('ColAddId'));
                $length2 =  count($temp2);

                for ($j=1; $j < $length2; $j++) {

                    if ($temp2[$j] != '') {
                        $results2 = new Collector();
                        $results2 = $this->em->getRepository(Collector::class)->findOneBy(array('id' => $temp2[$j]));
                        $modele->addCollector($results2);
                    }
                }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modele);
            $entityManager->flush();
            //récupèrer les id des medias, fecth les objets, ->addModele avec l'id du modele

            //Media
                $id = $modele->getId();
                $temp3 = explode(',', $request->get('MedAddId'));
                $length3 =  count($temp3);
                 for ($l=1; $l < $length3; $l++) {

                    if ($temp3[$l] != '') {
                        $results3 = new Media();
                        $results3 = $this->em->getRepository(Media::class)->findOneBy(array('id' => $temp3[$l]));
                        $results3->setModele($modele);
                        $entityManager->persist($results3);
                        $entityManager->flush();
                    }
                }


            return $this->redirectToRoute('create');
        }

        return $this->render('create/type/Modele/show.html.twig', [
            'formModele' => $form->createView()
        ]);
    }

    /**
     * @Route("/Designer/{from}", name="create_designer")
     */
    public function createDesigner(Designer $designer = null, Request $request, ObjectManager $manager, $from = null) {

        if (!$designer) {
          $designer = new Designer();
        }

        $form = $this->createForm(DesignerType::class, $designer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($designer);
            $entityManager->flush();

            $id = $designer->getId();

            if ($from == 'Js') {
                return new Response($id);
            } else {
                return $this->redirectToRoute('create');
            }

        }

            return $this->render('create/type/Designer/show.html.twig', [
            'formDesigner' => $form->createView(),
            'result' => $designer
        ]);



    }

    /**
     * @Route("/Collector/{from}", name="create_collector")
     */
    public function createCollector(Collector $collector = null, Request $request, ObjectManager $manager, $from=null) {


        $collector = new Collector();

        $form = $this->createForm(CollectorType::class, $collector);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($collector);
            $entityManager->flush();

            $id = $collector->getId();

            if ($from == 'Js') {
                return new Response($id);
            } else {
                return $this->redirectToRoute('create');
            }
        }

            return $this->render('create/type/Collector/show.html.twig', [
            'formCollector' => $form->createView()
        ]);
    }

    /**
     * @Route("/Contact/", name="create_contact")
     */

    public function createContact(Contact $contact = null, Request $request, ObjectManager $manager) {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('create');
        }


            return $this->render('create/type/Address/show.html.twig', [
            'formContact' => $form->createView()
        ]);
    }

    /**
     * @Route("/Event/", name="create_event")
     */

    public function createEvent(Event $event = null, Request $request, ObjectManager $manager) {

        $event = new Event();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('create');
        }


            return $this->render('create/type/Event/show.html.twig', [
            'formEvent' => $form->createView()
        ]);
    }

    /**
     * @Route("/Club/", name="create_club")
     */

    public function createClub(Club $club = null, Request $request, ObjectManager $manager) {

        $club = new Club();

        $form = $this->createForm(ClubType::class, $club);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('create');
        }


            return $this->render('create/type/Club/show.html.twig', [
            'formClub' => $form->createView()
        ]);
    }

    /**
     * @Route("/Media/{from}", name="create_media")
     */
    public function createMedia(Media $media = null, Request $request, ObjectManager $manager, $from=null) {

        $media = new Media();

        $form = $this->createForm(MediaType::class, $media);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($media);
            $entityManager->flush();

            $id = $media->getId();

            if ($from == 'Js') {
                return new Response($id);
            }

        }

            return $this->render('create/type/Media/show.html.twig', [
            'formMedia' => $form->createView()
        ]);
    }
}
