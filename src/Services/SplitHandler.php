<?php

namespace App\Services;


use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormTypeInterface;




class SplitHandler {

  private $em;

    public function __construct(EntityManagerInterface $em) {

        $this->em = $em;

    }

  public function splitDel($request, $string, $modele, $manager) {

    $new_list = explode(',', $request->get($string));

    $string2 = "App\Entity\\$string";
    $methodRemove = 'remove'.$string;
    $methodAdd = 'add'.$string;
    $getMeth = 'get'.$string.'s';

    $objects = call_user_func([$modele, $getMeth]);

    // création de la liste courante
    if (count($objects)) {
      foreach($objects as $object) {
        $current_list[$object->getId()] = $object;
      }
    } else {
      $current_list = [];
    }

    // Remove
    foreach($current_list as $current_id => $id) {
      if(!in_array($current_id, $new_list)) {
        $object = $this->em->getRepository("App\Entity\\$string")->find($id);
        call_user_func(array($modele, $methodRemove), $object);
        unset($current_list[$current_id]);
      }
    }

    // add
    foreach($new_list as $id) {
      if(!key_exists($id, $current_list)) {
        if ($id != "") {
          $object = $this->em->getRepository("App\Entity\\$string")->find($id);
          if($string == 'Media') {
            $object->setModele($modele);
          } else {
            call_user_func(array($modele, $methodAdd), $object);
          }
          $manager->flush();
        }
      }
    }
  }

  public function handleDesigner($request, $string, $modele, $manager) {
    $this->splitDel($request, $string, $modele, $manager);
  }

  public function handleCollector($request, $string, $modele, $manager){
    $this->splitDel($request, $string, $modele, $manager);
  }

  public function handleMedia($request, $string, $modele, $manager) {
    $this->splitDel($request, $string, $modele, $manager);
  }

}
