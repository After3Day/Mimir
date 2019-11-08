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
* @Route("/delete")
*/
class DeleteController extends AbstractController
{
  private $em;

  public function __construct(EntityManagerInterface $em) {
     $this->em = $em;
  }

  /**
   * @Route("/", name="delete")
   *
   */
  public function deleteHome() {
     return $this->render('blog/home.html.twig');
  }

  /**
   * @Route("/Brand/{id}", name="delete_brand")
   */
  public function deleteBrand(Brand $brand = null, Request $request, ObjectManager $manager, $from = null) {
    $repository = $this->em->getRepository(Designer::class);

    $designer = $repository->find($id);

    $manager->remove($designer);
    $manager->flush();

    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/Modele/{id}", name="delete_modele")
   */
  public function deleteModele(Modele $modele = null, Request $request, ObjectManager $manager, $id) {
		$repository = $this->em->getRepository(Modele::class);

    $designer = $repository->find($id);

    $manager->remove($modele);
    $manager->flush();

    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/Designer/{id}", name="delete_designer")
   */
  public function deleteDesigner(Request $request, ObjectManager $manager, $id) {
    $repository = $this->em->getRepository(Designer::class);

    $designer = $repository->find($id);

    $manager->remove($designer);
    $manager->flush();

    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/Collector/{from}", name="delete_collector")
   */
  public function deleteCollector(Collector $collector = null, Request $request, ObjectManager $manager, $from=null) {
    $repository = $this->em->getRepository(Designer::class);

    $designer = $repository->find($id);

    $manager->remove($designer);
    $manager->flush();

    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/Contact/", name="delete_contact")
   */
  public function deleteContact(Contact $contact = null, Request $request, ObjectManager $manager) {
		$repository = $this->em->getRepository(Designer::class);

    $designer = $repository->find($id);

    $manager->remove($designer);
    $manager->flush();

    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/Event/{id}", name="delete_event")
   */
  public function deleteEvent(Event $event = null, Request $request, ObjectManager $manager, $id) {

    $repository = $this->em->getRepository(Event::class);

    $event = $repository->find($id);

    $manager->remove($event);
    $manager->flush();

    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/Club/{id}", name="delete_club")
   */
  public function deleteClub(Club $club = null, Request $request, ObjectManager $manager, $id) {
    $repository = $this->em->getRepository(Club::class);

    $club = $repository->find($id);

    $manager->remove($club);
    $manager->flush();

    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/Media/{from}", name="delete_media")
   */
  public function deleteMedia(Media $media = null, Request $request, ObjectManager $manager, $from=null) {
    $repository = $this->em->getRepository(Designer::class);

    $designer = $repository->find($id);

    $manager->remove($designer);
    $manager->flush();

    return $this->redirectToRoute('home');
  }
}
