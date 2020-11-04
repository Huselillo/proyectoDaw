<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreguntasRepository")
 */
class Preguntas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pregunta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $r1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $r2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $r3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correcta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $foto;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TestsPreguntas", mappedBy="id_pregunta")
     */
    private $testsPreguntas;

    public function __construct()
    {
        $this->testsPreguntas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPregunta(): ?string
    {
        return $this->pregunta;
    }

    public function setPregunta(string $pregunta): self
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    public function getR1(): ?string
    {
        return $this->r1;
    }

    public function setR1(string $r1): self
    {
        $this->r1 = $r1;

        return $this;
    }

    public function getR2(): ?string
    {
        return $this->r2;
    }

    public function setR2(string $r2): self
    {
        $this->r2 = $r2;

        return $this;
    }

    public function getR3(): ?string
    {
        return $this->r3;
    }

    public function setR3(string $r3): self
    {
        $this->r3 = $r3;

        return $this;
    }

    public function getCorrecta(): ?string
    {
        return $this->correcta;
    }

    public function setCorrecta(string $correcta): self
    {
        $this->correcta = $correcta;

        return $this;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return Collection|TestsPreguntas[]
     */
    public function getTestsPreguntas(): Collection
    {
        return $this->testsPreguntas;
    }

    public function addTestsPregunta(TestsPreguntas $testsPregunta): self
    {
        if (!$this->testsPreguntas->contains($testsPregunta)) {
            $this->testsPreguntas[] = $testsPregunta;
            $testsPregunta->addIdPreguntum($this);
        }

        return $this;
    }

    public function removeTestsPregunta(TestsPreguntas $testsPregunta): self
    {
        if ($this->testsPreguntas->contains($testsPregunta)) {
            $this->testsPreguntas->removeElement($testsPregunta);
            $testsPregunta->removeIdPreguntum($this);
        }

        return $this;
    }
}
