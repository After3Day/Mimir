<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Version", mappedBy="modele", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $versions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Collector", inversedBy="modeles", cascade={"persist"})
     */
    private $collectors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Designer", inversedBy="modeles", cascade={"persist",})
     */
    private $designers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="modele", cascade={"persist", "remove"})
     */
    private $medias;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $modele;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="modeles", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $engine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gearbox;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $frame;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $identification;

    public function __construct()
    {
        $this->versions = new ArrayCollection();
        $this->collectors = new ArrayCollection();
        $this->designers = new ArrayCollection();
        $this->medias = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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
            $this->versions->add($version);
            $version->setModele($this);
        }

        return $this;
    }

    public function removeVersion(Version $version): self
    {
        if ($this->versions->contains($version)) {
            $this->versions->removeElement($version);
            // set the owning side to null (unless already changed)
            if ($version->getModeles() === $this) {
                $version->setModeles(null);
            }
        }

        return $this;
    }

    public function isVersionExist()
    {
        (count($this->getVersions()) < 1) ? false : true;
    }

    /**
     * @return Collection|Collector[]
     */
    public function getCollectors(): Collection
    {
        return $this->collectors;
    }

    public function addCollector(Collector $collector): self
    {
        if (!$this->collectors->contains($collector)) {
            $this->collectors[] = $collector;
        }

        return $this;
    }

    public function removeCollector(Collector $collector): self
    {
        if ($this->collectors->contains($collector)) {
            $this->collectors->removeElement($collector);
        }

        return $this;
    }

    /**
     * @return Collection|Designer[]
     */
    public function getDesigners(): Collection
    {
        return $this->designers;
    }

    public function addDesigner(Designer $designer): self
    {
        if (!$this->designers->contains($designer)) {
            $this->designers[] = $designer;
        }

        return $this;
    }

    public function removeDesigner(Designer $designer): self
    {
        if ($this->designers->contains($designer)) {
            $this->designers->removeElement($designer);
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->media[] = $media;
            $media->setModeles($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->medias->contains($media)) {
            $this->medias->removeElement($media);
            // set the owning side to null (unless already changed)
            if ($media->getModeles() === $this) {
                $media->setModeles(null);
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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(?string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(?string $gearbox): self
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    public function getFrame(): ?string
    {
        return $this->frame;
    }

    public function setFrame(?string $frame): self
    {
        $this->frame = $frame;

        return $this;
    }

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    public function setIdentification(?string $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

}
