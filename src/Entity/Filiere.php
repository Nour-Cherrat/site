<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=FiliereRepository::class)
 * @Vich\Uploadable()
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

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="formation_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdfname;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="uploads", fileNameProperty="pdfname")
     */
    private $pdfFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

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

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Filiere
     */
    public function setFilename(?string $filename): Filiere
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Filiere
     */
    public function setImageFile(?File $imageFile): Filiere
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPdfname(): ?string
    {
        return $this->pdfname;
    }

    /**
     * @param string|null $pdfname
     * @return Filiere
     */
    public function setPdfname(?string $pdfname): Filiere
    {
        $this->pdfname = $pdfname;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPdfFile(): ?File
    {
        return $this->pdfFile;
    }

    /**
     * @param File|null $pdfFile
     * @return Filiere
     */
    public function setPdfFile(?File $pdfFile): Filiere
    {
        $this->pdfFile = $pdfFile;
        if ($this->pdfFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     * @return Filiere
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }


}
