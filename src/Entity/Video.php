<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
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
    private $titre;

    /**
     * @ORM\Column(type="float")
     */
    private $taille;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAjout;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrTelechargement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrLike;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrUnlike;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $format;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="video")
     */
    private $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity=Contributeur::class, inversedBy="videos")
     */
    private $contributeur;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): self
    {
        $this->taille = $taille;

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

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getNbrTelechargement(): ?int
    {
        return $this->nbrTelechargement;
    }

    public function setNbrTelechargement(?int $nbrTelechargement): self
    {
        $this->nbrTelechargement = $nbrTelechargement;

        return $this;
    }

    public function getNbrLike(): ?int
    {
        return $this->nbrLike;
    }

    public function setNbrLike(?int $nbrLike): self
    {
        $this->nbrLike = $nbrLike;

        return $this;
    }

    public function getNbrUnlike(): ?int
    {
        return $this->nbrUnlike;
    }

    public function setNbrUnlike(?int $nbrUnlike): self
    {
        $this->nbrUnlike = $nbrUnlike;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setVideo($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getVideo() === $this) {
                $commentaire->setVideo(null);
            }
        }

        return $this;
    }

    public function getContributeur(): ?Contributeur
    {
        return $this->contributeur;
    }

    public function setContributeur(?Contributeur $contributeur): self
    {
        $this->contributeur = $contributeur;

        return $this;
    }
}
