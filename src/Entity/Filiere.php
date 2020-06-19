<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FiliereRepository::class)
 */
class Filiere
{
    const CATEGORIE = [
        1 => 'TC',
        2 => 'LST',
        3 => 'CI',
        4 => 'M',
        5 => 'PHD'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $modules;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_resp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email_resp;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug() : string
    {
        return (new Slugify())->slugify($this->nom);
    }

    public function getModules(): ?string
    {
        return $this->modules;
    }

    public function setModules(string $modules): self
    {
        $this->modules = $modules;

        return $this;
    }

    public function getNomResp(): ?string
    {
        return $this->nom_resp;
    }

    public function setNomResp(?string $nom_resp): self
    {
        $this->nom_resp = $nom_resp;

        return $this;
    }

    public function getEmailResp(): ?string
    {
        return $this->email_resp;
    }

    public function setEmailResp(?string $email_resp): self
    {
        $this->email_resp = $email_resp;

        return $this;
    }

    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    public function setCategorie(int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCategorieType() : string
    {
        return self::CATEGORIE[$this->categorie];
    }
}
