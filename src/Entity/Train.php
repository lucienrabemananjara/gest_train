<?php

namespace App\Entity;

use App\Repository\TrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainRepository::class)
 */
class Train
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
    private $numTrain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designTrain;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrPlace;

    /**
     * @ORM\ManyToOne(targetEntity=Itineraire::class, inversedBy="trains")
     */
    private $itineraires;

    /**
     * @ORM\OneToMany(targetEntity=Place::class, mappedBy="trains")
     */
    private $places;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="trains")
     */
    private $reservations;

    public function __construct()
    {
        $this->places = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumTrain(): ?string
    {
        return $this->numTrain;
    }

    public function setNumTrain(string $numTrain): self
    {
        $this->numTrain = $numTrain;

        return $this;
    }

    public function getDesignTrain(): ?string
    {
        return $this->designTrain;
    }

    public function setDesignTrain(string $designTrain): self
    {
        $this->designTrain = $designTrain;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbrPlace;
    }

    public function setNbrPlace(int $nbrPlace): self
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    public function getItineraires(): ?Itineraire
    {
        return $this->itineraires;
    }

    public function setItineraires(?Itineraire $itineraires): self
    {
        $this->itineraires = $itineraires;

        return $this;
    }

    /**
     * @return Collection<int, Place>
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
            $place->setTrains($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->places->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getTrains() === $this) {
                $place->setTrains(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setTrains($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getTrains() === $this) {
                $reservation->setTrains(null);
            }
        }

        return $this;
    }
}
