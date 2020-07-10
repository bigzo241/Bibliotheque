<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $designation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="categorie", orphanRemoval=true)
     */
    private $videos;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="categorie", orphanRemoval=true)
     */
    private $Documents;

    /**
     * @ORM\ManyToOne(targetEntity=SuperCategorie::class, inversedBy="categories")
     */
    private $supercategorie;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
        $this->Documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setCategorie($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getCategorie() === $this) {
                $video->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->Documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->Documents->contains($document)) {
            $this->Documents[] = $document;
            $document->setCategorie($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->Documents->contains($document)) {
            $this->Documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getCategorie() === $this) {
                $document->setCategorie(null);
            }
        }

        return $this;
    }

    public function getSupercategorie(): ?SuperCategorie
    {
        return $this->supercategorie;
    }

    public function setSupercategorie(?SuperCategorie $supercategorie): self
    {
        $this->supercategorie = $supercategorie;

        return $this;
    }
}
