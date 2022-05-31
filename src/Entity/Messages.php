<?php

namespace App\Entity;

use DateTimeInterface;
use App\Entity\Utilisateurs;
    use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MessagesRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MessagesRepository::class)
 * @UniqueEntity("titre_message")
 */

class Messages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre_message;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     * @Gedmo\Slug(fields={"titre_message"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creer_date;

        /**
     * @ORM\Column(type="boolean")
     */
    private $si_messageLu = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="message_envoyer", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="message_recu", cascade={"persist"})
     */
    private $medias;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="message_recu", cascade={"persist"})
     */
    private $destinataire = [];
    
    public function __construct()
    {
        $this->creer_date = new 
        \DateTime();
        }

    public function getId       (): ?int
    {
        return $this->id;
    }

    public function getTitreMessage(): ?string
    {
        return $this->titre_message;
    }

    public function setTitreMessage(?string $titre_message): self
    {
        $this->titre_message = $titre_message;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSiMessageLu(): ?bool
    {
        return $this->si_messageLu;
    }

    public function setSiMessageLu(bool $si_messageLu): self
    {
        $this->si_messageLu = $si_messageLu;

        return $this;
    }

    public function getCreerDate(): ?\DateTimeInterface
    {
        return $this->creer_date;
    }

    public function setCreerDate(\DateTimeInterface $creer_date): self
    {
        $this->creer_date = $creer_date;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getExpediteur(): ?Utilisateurs
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Utilisateurs $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }


    public function getMedias(): ?Utilisateurs
    {
        return $this->medias;
    }

    public function setMedias(?Utilisateurs $medias): self
    {
        $this->medias = $medias;

        return $this;
    }

    public function getDestinataire(): ?Utilisateurs
    {
        return $this->destinataire;
    }

    public function setDestinataire(?Utilisateurs $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    

}
