<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
    private $numReservation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomVoyageur;

    /**
     * @ORM\Column(type="date")
     */
    private $dateReservation;

    /**
     * @ORM\ManyToOne(targetEntity=Train::class, inversedBy="reservations")
     */
    private $trains;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="reservations")
     */
    private $places;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumReservation(): ?string
    {
        return $this->numReservation;
    }

    public function setNumReservation(string $numReservation): self
    {
        $this->numReservation = $numReservation;

        return $this;
    }

    public function getNomVoyageur(): ?string
    {
        return $this->nomVoyageur;
    }

    public function setNomVoyageur(string $nomVoyageur): self
    {
        $this->nomVoyageur = $nomVoyageur;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

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

    public function getPlaces(): ?Place
    {
        return $this->places;
    }

    public function setPlaces(?Place $places): self
    {
        $this->places = $places;

        return $this;
    }
}
