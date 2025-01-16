<?php

namespace App\Entity;

use App\Repository\RouteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouteRepository::class)]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'route')]
    private Collection $orderId;

    #[ORM\ManyToOne(inversedBy: 'routes')]
    private ?Truck $truck = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $route_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $estimated_duration = null;

    #[ORM\Column]
    private ?int $total_distance = null;

    public function __construct()
    {
        $this->orderId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderId(): Collection
    {
        return $this->orderId;
    }

    public function addOrderId(Order $orderId): static
    {
        if (!$this->orderId->contains($orderId)) {
            $this->orderId->add($orderId);
            $orderId->setRoute($this);
        }

        return $this;
    }

    public function removeOrderId(Order $orderId): static
    {
        if ($this->orderId->removeElement($orderId)) {
            // set the owning side to null (unless already changed)
            if ($orderId->getRoute() === $this) {
                $orderId->setRoute(null);
            }
        }

        return $this;
    }

    public function getTruck(): ?Truck
    {
        return $this->truck;
    }

    public function setTruck(?Truck $truck): static
    {
        $this->truck = $truck;

        return $this;
    }

    public function getRouteDate(): ?\DateTimeInterface
    {
        return $this->route_date;
    }

    public function setRouteDate(\DateTimeInterface $route_date): static
    {
        $this->route_date = $route_date;

        return $this;
    }

    public function getEstimatedDuration(): ?\DateTimeInterface
    {
        return $this->estimated_duration;
    }

    public function setEstimatedDuration(\DateTimeInterface $estimated_duration): static
    {
        $this->estimated_duration = $estimated_duration;

        return $this;
    }

    public function getTotalDistance(): ?int
    {
        return $this->total_distance;
    }

    public function setTotalDistance(int $total_distance): static
    {
        $this->total_distance = $total_distance;

        return $this;
    }
}
