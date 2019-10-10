<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 */
class Visiteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $mdp;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cp;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ville;

    /**
     * @ORM\Column(type="datetime" )
     */
    private $date_embauche;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheFrais", mappedBy="idVisiteur")
     */
    private $ficheFrais;

    public function __construct()
    {
        $this->ficheFrais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }
    function getVille() {
        return $this->ville;
    }

    function getDate_embauche() {
        return $this->date_embauche;
    }

        public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    
   

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setDate_embauche($date_embauche) {
        $this->date_embauche = $date_embauche;
    }

    /**
     * @return Collection|FicheFrais[]
     */
    public function getFicheFrais(): Collection
    {
        return $this->ficheFrais;
    }

    public function addFicheFrai(FicheFrais $ficheFrai): self
    {
        if (!$this->ficheFrais->contains($ficheFrai)) {
            $this->ficheFrais[] = $ficheFrai;
            $ficheFrai->setIdVisiteur($this);
        }

        return $this;
    }

    public function removeFicheFrai(FicheFrais $ficheFrai): self
    {
        if ($this->ficheFrais->contains($ficheFrai)) {
            $this->ficheFrais->removeElement($ficheFrai);
            // set the owning side to null (unless already changed)
            if ($ficheFrai->getIdVisiteur() === $this) {
                $ficheFrai->setIdVisiteur(null);
            }
        }

        return $this;
    }


}
