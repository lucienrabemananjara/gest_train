<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
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
    private $numPlace;

    /**
     * @ORM\Column(type="boolean")
     */
    private $occupation;

    /**
     * @ORM\ManyToOne(targetEntity=Train::class, inversedBy="places")
     */
    private $trains;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="places")
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumPlace(): ?string
    {
        return $this->numPlace;
    }

    public function setNumPlace(string $numPlace): self
    {
        $this->numPlace = $numPlace;

        return $this;
    }

    public function getOccupation(): ?bool
    {
        return $this->occupation;
    }

    public function setOccupation(bool $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getTrains(): ?Train
    {
        return $this->trains;
    }

    public function setTrains(?Train $trains): self
    {
        $this->trains = $trains;

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
            $reservation->setPlaces($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPlaces() === $this) {
                $reservation->setPlaces(null);
            }
        }

        return $this;
    }
}
