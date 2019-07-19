<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VersionRepository")
 */
class Version
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
    private $versionName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modele", inversedBy="versionId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modeleId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersionName(): ?string
    {
        return $this->versionName;
    }

    public function setVersionName(string $versionName): self
    {
        $this->versionName = $versionName;

        return $this;
    }

    public function getModeleId(): ?Modele
    {
        return $this->modeleId;
    }

    public function setModeleId(?Modele $modeleId): self
    {
        $this->modeleId = $modeleId;

        return $this;
    }
}
