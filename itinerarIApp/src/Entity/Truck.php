<?php

namespace App\Entity;

use App\Repository\TruckRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TruckRepository::class)]
class Truck
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Driver $driver = null;

    #[ORM\Column(length: 255)]
    private ?string $availability = null;

    #[ORM\Column]
    private ?int $max_mass = null;

    #[ORM\Column]
    private ?int $max_volume = null;

    /**
     * @var Collection<int, Route>
     */
    #[ORM\OneToMany(targetEntity: Route::class, mappedBy: 'truck')]
    private Collection $routes;

    #[ORM\Column(length: 255)]
    private ?string $license_plate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $max_permissible_volume = null;

    public function __construct()
    {
        $this->routes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): static
    {
        $this->driver = $driver;

        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(string $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    public function getMaxMass(): ?int
    {
        return $this->max_mass;
    }

    public function setMaxMass(int $max_mass): static
    {
        $this->max_mass = $max_mass;

        return $this;
    }

    public function getMaxVolume(): ?int
    {
        return $this->max_volume;
    }

    public function setMaxVolume(int $max_volume): static
    {
        $this->max_volume = $max_volume;

        return $this;
    }

    /**
     * @return Collection<int, Route>
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    public function addRoute(Route $route): static
    {
        if (!$this->routes->contains($route)) {
            $this->routes->add($route);
            $route->setTruck($this);
        }

        return $this;
    }

    public function removeRoute(Route $route): static
    {
        if ($this->routes->removeElement($route)) {
            // set the owning side to null (unless already changed)
            if ($route->getTruck() === $this) {
                $route->setTruck(null);
            }
        }

        return $this;
    }

    public function getLicensePlate(): ?string
    {
        return $this->license_plate;
    }

    public function setLicensePlate(string $license_plate): static
    {
        $this->license_plate = $license_plate;

        return $this;
    }

    public function getMaxPermissibleVolume(): ?string
    {
        return $this->max_permissible_volume;
    }

    public function setMaxPermissibleVolume(string $max_permissible_volume): static
    {
        $this->max_permissible_volume = $max_permissible_volume;

        return $this;
    }
}
