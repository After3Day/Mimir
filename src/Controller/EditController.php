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
Use App\Entity\Version;

Use App\Services\SplitHandler;

Use App\Form\ModeleType;
Use App\Form\BrandType;
Use App\Form\ClubType;
Use App\Form\EventType;
Use App\Form\CollectorType;
Use App\Form\DesignerType;
Use App\Form\ContactType;
Use App\Form\AddressType;
Use App\Form\MediaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* @Route("/edit")
*
* Require ROLE_USER for *every* controller method in this class.
*
* @IsGranted("ROLE_USER")
*/

class EditController extends AbstractController
{
    private $em;
    private $spliter;

    public function __construct(EntityManagerInterface $em, SplitHandler $spliter) {

        $this->em = $em;
        $this->spliter = $spliter;

    }

    /**
     * @Route("/", name="edit")
     *
     */
    public function editHome() {

        return $this->render('edit/type/home.html.twig');

    }

    /**
     * @Route("/Brand/{from}", name="edit_brand")
     */
    public function editBrand(Brand $brand = null, Request $request, ObjectManager $manager, $from = null) {

        $brand = new Brand();

        $form = $this->editForm(BrandType::class, $brand);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brand);
            $entityManager->flush();

            $id = $brand->getId();

            if ($from == 'Js') {
                return new Response($id);
            } else {
                return $this->redirectToRoute('edit');
            }
        }

            return $this->render('edit/type/Brand/show.html.twig', [
            'formBrand' => $form->editView()
        ]);
    }

    /**
     * @Route("/Modele/{id}", name="edit_modele")
     */
    public function editModele(Modele $modele = null, Request $request, ObjectManager $manager, $id) {

        $repository = $this->em->getRepository(Modele::class);

        $modele = $repository->findOneById($id);

        $form = $this->createForm(ModeleType::class, $modele);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Ne Marche qu'une fois ?

            $this->spliter->handleCollector($request, 'Collector', $modele, $manager);
            $this->spliter->handleDesigner($request, 'Designer', $modele, $manager);

            $manager->persist($modele);
            $manager->flush();

            $this->spliter->handleMedia($request, 'Media', $modele, $manager);


            return $this->redirectToRoute('home');
        }
        return $this->render('edit/type/Modele/edit.html.twig', [
                'formModele' => $form->createView(),
                'result' => $modele,
                'id' => $id
            ]);
    }

    /**
     * @Route("/Designer/{id}", name="edit_designer")
     */
    public function editDesigner(Designer $designer = null, Request $request, ObjectManager $manager, $id) {

        $repository = $this->em->getRepository(Designer::class);

        $designer = $repository->find($id);

        $form = $this->createForm(DesignerType::class, $designer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($designer);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('edit/type/Designer/edit.html.twig', [
                'formDesigner' => $form->createView(),
                'id' => $id
            ]);
    }

    /**
     * @Route("/Collector/{id}", name="edit_collector")
     */
    public function editCollector(Collector $collector = null, Request $request, ObjectManager $manager, $id) {

        $repository = $this->em->getRepository(Collector::class);

        $collector = $repository->find($id);

        $form = $this->createForm(CollectorType::class, $collector);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($collector);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

            return $this->render('edit/type/Collector/edit.html.twig', [
            'formCollector' => $form->createView(),
            'collector' => $collector,
            'id' => $id
        ]);
    }

    /**
     * @Route("/Contact/", name="edit_contact")
     */

    public function editContact(Contact $contact = null, Request $request, ObjectManager $manager) {

        $contact = new Contact();

        $form = $this->editForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('edit');
        }


            return $this->render('edit/type/Address/show.html.twig', [
            'formContact' => $form->editView()
        ]);
    }

    /**
     * @Route("/Event/{id}", name="edit_event")
     */

    public function editEvent(Event $event = null, Request $request, ObjectManager $manager, $id) {

        $repository = $this->em->getRepository(Event::class);

        $event = $repository->find($id);

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('home');
        }


            return $this->render('edit/type/Event/edit.html.twig', [
            'formEvent' => $form->createView(),
            'id' => $id
        ]);
    }

    /**
     * @Route("/Club/{id}", name="edit_club")
     */

    public function editClub(Club $club = null, Request $request, ObjectManager $manager, $id) {

        $repository = $this->em->getRepository(Club::class);

        $club = $repository->find($id);

        $form = $this->createForm(ClubType::class, $club);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }


            return $this->render('edit/type/Club/edit.html.twig', [
            'formClub' => $form->createView(),
            'id' => $id
        ]);
    }

    /**
     * @Route("/Media/{id}", name="edit_media")
     */
    public function editMedia(Media $media = null, Request $request, ObjectManager $manager, $id) {

        $repository = $this->em->getRepository(Media::class);

        $media = $repository->find($id);

        $form = $this->createForm(MediaType::class, $media);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($media);
            $entityManager->flush();

            return $this->redirectToRoute('home');

        }

            return $this->render('edit/type/Media/edit.html.twig', [
            'formMedia' => $form->createView(),
            'id' => $id
        ]);
    }
}
