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
     * @ORM\OneToMany(targetEntity="App\Entity\Version", mappedBy="modele", orphanRemoval=true)
     */
    private $versions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Collector", inversedBy="modeles")
     */
    private $collectors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Designer", inversedBy="modeles")
     */
    private $designers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="modele")
     */
    private $medias;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="modeles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

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
            $this->versions[] = $version;
            $version->setModeles($this);
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

}
