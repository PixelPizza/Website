<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource(
	operations: [
		new GetCollection(),
		new Post(
			denormalizationContext: [
				'groups' => ['order:write', 'order:item:post']
			]
		),
		new Get(),
		new Delete(),
		new Patch(
			denormalizationContext: [
				'groups' => ['order:write', 'order:item:patch']
			]
		)
	],
	normalizationContext: [
		'groups' => ['order:read']
	],
	denormalizationContext: [
		'groups' => ['order:write']
	],
	extraProperties: [
		'standard_put' => true,
	],
)]
class Order
{
	use TimestampableEntity {
		getCreatedAt as private traitGetCreatedAt;
	}
	
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(length: 3)]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\NumericStringIdGenerator')]
    #[Groups(['order:read'])]
    private ?string $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['order:read', 'order:write'])]
    #[SerializedName('order')]
    #[Assert\NotBlank]
    private ?string $orderText = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    private ?\DateTimeImmutable $cookedAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    private ?\DateTimeImmutable $deliveredAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    #[Assert\Length(max: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 20)]
    #[Groups(['order:read', 'order:item:post'])]
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    #[Assert\Regex(
	    pattern: '/^\d+$/',
	    message: 'This value should be numeric'
    )]
    private ?string $customer = null;

    #[ORM\Column(length: 20)]
    #[Groups(['order:read', 'order:item:post'])]
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    #[Assert\Regex(
	    pattern: '/^\d+$/',
	    message: 'This value should be numeric'
    )]
    private ?string $guild = null;

    #[ORM\Column(length: 20)]
    #[Groups(['order:read', 'order:item:post'])]
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    #[Assert\Regex(
	    pattern: '/^\d+$/',
	    message: 'This value should be numeric'
    )]
    private ?string $channel = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    #[Assert\Length(max: 20)]
    #[Assert\Regex(
	    pattern: '/^\d+$/',
	    message: 'This value should be numeric'
    )]
    private ?string $chef = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    #[Assert\Length(max: 20)]
    #[Assert\Regex(
		pattern: '/^\d+$/',
	    message: 'This value should be numeric'
    )]
    private ?string $deliverer = null;

    public function getId(): ?string
    {
        return $this->id;
    }
	
    public function getOrderText(): ?string
    {
        return $this->orderText;
    }
	
    public function setOrderText(string $orderText): static
    {
        $this->orderText = $orderText;

        return $this;
    }
	
	#[Groups(['order:read'])]
	#[SerializedName('orderedAt')]
	public function getCreatedAt(): ?\DateTime
	{
	  return $this->traitGetCreatedAt();
	}

    public function getCookedAt(): ?\DateTimeImmutable
    {
        return $this->cookedAt;
    }

    public function setCookedAt(?\DateTimeImmutable $cookedAt): static
    {
        $this->cookedAt = $cookedAt;

        return $this;
    }

    public function getDeliveredAt(): ?\DateTimeImmutable
    {
        return $this->deliveredAt;
    }

    public function setDeliveredAt(?\DateTimeImmutable $deliveredAt): static
    {
        $this->deliveredAt = $deliveredAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getGuild(): ?string
    {
        return $this->guild;
    }

    public function setGuild(string $guild): static
    {
        $this->guild = $guild;

        return $this;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): static
    {
        $this->channel = $channel;

        return $this;
    }

    public function getChef(): ?string
    {
        return $this->chef;
    }

    public function setChef(?string $chef): static
    {
        $this->chef = $chef;

        return $this;
    }

    public function getDeliverer(): ?string
    {
        return $this->deliverer;
    }

    public function setDeliverer(?string $deliverer): static
    {
        $this->deliverer = $deliverer;

        return $this;
    }
}
