<?php

namespace App\Entity;

use App\Repository\ItineraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItineraireRepository::class)
 */
class Itineraire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numItineraire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeDepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeArrivee;

    /**
     * @ORM\Column(type="integer")
     */
    private $frais;

    /**
     * @ORM\OneToMany(targetEntity=Train::class, mappedBy="itineraires")
     */
    private $trains;

    public function __construct()
    {
        $this->trains = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumItineraire(): ?string
    {
        return $this->numItineraire;
    }

    public function setNumItineraire(string $numItineraire): self
    {
        $this->numItineraire = $numItineraire;

        return $this;
    }

    public function getVilleDepart(): ?string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(string $villeDepart): self
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    public function getVilleArrivee(): ?string
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(string $villeArrivee): self
    {
        $this->villeArrivee = $villeArrivee;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    /**
     * @return Collection<int, Train>
     */
    public function getTrains(): Collection
    {
        return $this->trains;
    }

    public function addTrain(Train $train): self
    {
        if (!$this->trains->contains($train)) {
            $this->trains[] = $train;
            $train->setItineraires($this);
        }

        return $this;
    }

    public function removeTrain(Train $train): self
    {
        if ($this->trains->removeElement($train)) {
            // set the owning side to null (unless already changed)
            if ($train->getItineraires() === $this) {
                $train->setItineraires(null);
            }
        }

        return $this;
    }
}
