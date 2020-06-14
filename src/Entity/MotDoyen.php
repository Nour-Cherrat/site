<?php

namespace App\Entity;

use App\Repository\MotDoyenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotDoyenRepository::class)
 */
class MotDoyen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $quote;

    /**
     * @ORM\Column(type="text")
     */
    private $motD;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(?string $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getMotD(): ?string
    {
        return $this->motD;
    }

    public function setMotD(string $motD): self
    {
        $this->motD = $motD;

        return $this;
    }
}
