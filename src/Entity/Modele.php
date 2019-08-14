<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeleRepository")
 */
class Modele
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manufacturerName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Version", mappedBy="modeleId", orphanRemoval=true)
     */
    private $versions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Collector", inversedBy="modeles")
     */
    private $collectorId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Designer", inversedBy="modeles")
     */
    private $designerId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="modeleId")
     */
    private $mediaId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    public function __construct()
    {
        $this->versions = new ArrayCollection();
        $this->collectorId = new ArrayCollection();
        $this->designerId = new ArrayCollection();
        $this->mediaId = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturerName(): ?string
    {
        return $this->manufacturerName;
    }

    public function setManufacturerName(string $manufacturerName): self
    {
        $this->manufacturerName = $manufacturerName;

        return $this;
    }

    /**
     * @return Collection|Version[]
     */
    public function getVersions(): Collection
    {
        return $this->versions;
    }

    public function addVersion(Version $version): self
    {
        if (!$this->versions->contains($version)) {
            $this->versions[] = $version;
            $version->setModeleId($this);
        }

        return $this;
    }

    public function removeVersion(Version $version): self
    {
        if ($this->versions->contains($version)) {
            $this->versions->removeElement($version);
            // set the owning side to null (unless already changed)
            if ($version->getModeleId() === $this) {
                $version->setModeleId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Collector[]
     */
    public function getCollectorId(): Collection
    {
        return $this->collectorId;
    }

    public function addCollectorId(Collector $collectorId): self
    {
        if (!$this->collectorId->contains($collectorId)) {
            $this->collectorId[] = $collectorId;
        }

        return $this;
    }

    public function removeCollectorId(Collector $collectorId): self
    {
        if ($this->collectorId->contains($collectorId)) {
            $this->collectorId->removeElement($collectorId);
        }

        return $this;
    }

    /**
     * @return Collection|Designer[]
     */
    public function getDesignerId(): Collection
    {
        return $this->designerId;
    }

    public function addDesignerId(Designer $designerId): self
    {
        if (!$this->designerId->contains($designerId)) {
            $this->designerId[] = $designerId;
        }

        return $this;
    }

    public function removeDesignerId(Designer $designerId): self
    {
        if ($this->designerId->contains($designerId)) {
            $this->designerId->removeElement($designerId);
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMediaId(): Collection
    {
        return $this->mediaId;
    }

    public function addMediaId(Media $mediaId): self
    {
        if (!$this->mediaId->contains($mediaId)) {
            $this->mediaId[] = $mediaId;
            $mediaId->setModeleId($this);
        }

        return $this;
    }

    public function removeMediaId(Media $mediaId): self
    {
        if ($this->mediaId->contains($mediaId)) {
            $this->mediaId->removeElement($mediaId);
            // set the owning side to null (unless already changed)
            if ($mediaId->getModeleId() === $this) {
                $mediaId->setModeleId(null);
            }
        }

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

}
