<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource()
 * @ORM\Table(name="messages")
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Groups({"customer"})
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Type(type="App\Entity\Customer")
     */
    private $createdBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreatedBy(): ?Customer
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Customer $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
