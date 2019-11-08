<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormTypeInterface;

use App\Repository\ModeleRepository;
use App\Repository\BrandRepository;
use App\Repository\ClubRepository;
use App\Repository\EventRepository;
use App\Repository\CollectorRepository;
use App\Repository\DesignerRepository;

class EmbeddedFormHandler extends Controller{

  public function EmbeddedForm($request, $entity, $form, $entityManager) {

    $form->handleRequest($request);

    $test = 'Collector';

    $object = new $test();

    $results = $this->em->getRepository("App\Entity\\$test")->findOneBy(array('id' => $temp[$i]));

    if ($form->isSubmitted() && $form->isValid()) {

      $entityManager->persist($entity);
      $entityManager->flush();

      $id = $entity->getId();
    }
  }
}
