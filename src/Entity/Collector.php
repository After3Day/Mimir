<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CollectorRepository")
 */
class Collector
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Contact", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $contactId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Modele", mappedBy="collectorId")
     */
    private $modeles;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContactId(): ?Contact
    {
        return $this->contactId;
    }

    public function setContactId(Contact $contactId): self
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * @return Collection|Modele[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): self
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles[] = $modele;
            $modele->addCollectorId($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->contains($modele)) {
            $this->modeles->removeElement($modele);
            $modele->removeCollectorId($this);
        }

        return $this;
    }

}
