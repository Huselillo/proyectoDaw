<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestsRepository")
 */
class Tests
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TestsPreguntas", mappedBy="id_test")
     */
    private $testsPreguntas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

    public function __construct()
    {
        $this->testsPreguntas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

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
            $testsPregunta->addIdTest($this);
        }

        return $this;
    }

    public function removeTestsPregunta(TestsPreguntas $testsPregunta): self
    {
        if ($this->testsPreguntas->contains($testsPregunta)) {
            $this->testsPreguntas->removeElement($testsPregunta);
            $testsPregunta->removeIdTest($this);
        }

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }
}
