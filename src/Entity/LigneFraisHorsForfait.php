<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneFraisHorsForfaitRepository")
 */
class LigneFraisHorsForfait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Visiteur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idVisiteur;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $mois;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVisiteur(): ?Visiteur
    {
        return $this->idVisiteur;
    }

    public function setIdVisiteur(Visiteur $idVisiteur): self
    {
        $this->idVisiteur = $idVisiteur;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $mantant): self
    {
        $this->montant = $mantant;

        return $this;
    }
}
