<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PracticasRepository")
 */
class Practicas
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
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profesor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hora;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmado;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuarios", inversedBy="practicas")
     */
    private $idUsuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_profesor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $realizada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getProfesor(): ?string
    {
        return $this->profesor;
    }

    public function setProfesor(string $profesor): self
    {
        $this->profesor = $profesor;

        return $this;
    }

    public function getHora(): ?string
    {
        return $this->hora;
    }

    public function setHora(string $hora): self
    {
        $this->hora = $hora;

        return $this;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getConfirmado(): ?string
    {
        return $this->confirmado;
    }

    public function setConfirmado(?string $confirmado): self
    {
        $this->confirmado = $confirmado;

        return $this;
    }

    public function getIdUsuario(): ?Usuarios
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuarios $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function getIdProfesor(): ?string
    {
        return $this->id_profesor;
    }

    public function setIdProfesor(string $id_profesor): self
    {
        $this->id_profesor = $id_profesor;

        return $this;
    }

    public function getRealizada(): ?string
    {
        return $this->realizada;
    }

    public function setRealizada(?string $realizada): self
    {
        $this->realizada = $realizada;

        return $this;
    }
}
