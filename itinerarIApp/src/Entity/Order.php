<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderId')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $delivery_date = null;

    #[ORM\Column(length: 255)]
    private ?string $delivery_address = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 17, scale: 15)]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 17, scale: 15)]
    private ?string $longitude = null;

    #[ORM\Column(length: 255)]
    private ?string $box_type = null;

    #[ORM\Column(length: 255)]
    private ?string $maximum_permissible_mass = null;

    #[ORM\Column(length: 255)]
    private ?string $maximum_permissible_volume = null;

    #[ORM\ManyToOne(inversedBy: 'orderId')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Route $route = null;

    #[ORM\Column]
    private ?int $sequence = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(\DateTimeInterface $delivery_date): static
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->delivery_address;
    }

    public function setDeliveryAddress(string $delivery_address): static
    {
        $this->delivery_address = $delivery_address;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getBoxType(): ?string
    {
        return $this->box_type;
    }

    public function setBoxType(string $box_type): static
    {
        $this->box_type = $box_type;

        return $this;
    }

    public function getMaximumPermissibleMass(): ?string
    {
        return $this->maximum_permissible_mass;
    }

    public function setMaximumPermissibleMass(string $maximum_permissible_mass): static
    {
        $this->maximum_permissible_mass = $maximum_permissible_mass;

        return $this;
    }

    public function getMaximumPermissibleVolume(): ?string
    {
        return $this->maximum_permissible_volume;
    }

    public function setMaximumPermissibleVolume(string $maximum_permissible_volume): static
    {
        $this->maximum_permissible_volume = $maximum_permissible_volume;

        return $this;
    }

    public function getRoute(): ?Route
    {
        return $this->route;
    }

    public function setRoute(?Route $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    public function setSequence(int $sequence): static
    {
        $this->sequence = $sequence;

        return $this;
    }
}
