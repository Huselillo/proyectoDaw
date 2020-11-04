<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemasRepository")
 */
class Temas
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
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $archivo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $permiso;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getTitulo1(): ?string
    {
        return $this->titulo1;
    }

    public function setTitulo1(string $titulo1): self
    {
        $this->titulo1 = $titulo1;

        return $this;
    }

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(string $archivo): self
    {
        $this->archivo = $archivo;

        return $this;
    }

    public function getPermiso(): ?string
    {
        return $this->permiso;
    }

    public function setPermiso(string $permiso): self
    {
        $this->permiso = $permiso;

        return $this;
    }
}
