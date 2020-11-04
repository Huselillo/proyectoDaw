<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestsPreguntasRepository")
 */
class TestsPreguntas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tests", inversedBy="testsPreguntas")
     */
    private $id_test;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Preguntas", inversedBy="testsPreguntas")
     */
    private $id_pregunta;

    public function __construct()
    {
        $this->id_test = new ArrayCollection();
        $this->id_pregunta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Tests[]
     */
    public function getIdTest(): Collection
    {
        return $this->id_test;
    }

    public function addIdTest(Tests $idTest): self
    {
        if (!$this->id_test->contains($idTest)) {
            $this->id_test[] = $idTest;
        }

        return $this;
    }

    public function removeIdTest(Tests $idTest): self
    {
        if ($this->id_test->contains($idTest)) {
            $this->id_test->removeElement($idTest);
        }

        return $this;
    }

    /**
     * @return Collection|Preguntas[]
     */
    public function getIdPregunta(): Collection
    {
        return $this->id_pregunta;
    }

    public function addIdPreguntum(Preguntas $idPreguntum): self
    {
        if (!$this->id_pregunta->contains($idPreguntum)) {
            $this->id_pregunta[] = $idPreguntum;
        }

        return $this;
    }

    public function removeIdPreguntum(Preguntas $idPreguntum): self
    {
        if ($this->id_pregunta->contains($idPreguntum)) {
            $this->id_pregunta->removeElement($idPreguntum);
        }

        return $this;
    }
}
