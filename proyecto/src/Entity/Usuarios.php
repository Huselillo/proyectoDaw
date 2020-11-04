<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios implements UserInterface, \Serializable
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tests_aprobados;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $aciertos_tests;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tests_realizados;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo_usuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contrasena;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Practicas", mappedBy="idUsuario")
     */
    private $practicas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $practicas_realizadas;

    public function __construct()
    {
        $this->practicas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTestsAprobados(): ?int
    {
        return $this->tests_aprobados;
    }

    public function setTestsAprobados(?int $tests_aprobados): self
    {
        $this->tests_aprobados = $tests_aprobados;

        return $this;
    }

    public function getAciertosTests(): ?int
    {
        return $this->aciertos_tests;
    }

    public function setAciertosTests(?int $aciertos_tests): self
    {
        $this->aciertos_tests = $aciertos_tests;

        return $this;
    }

    public function getTestsRealizados(): ?int
    {
        return $this->tests_realizados;
    }

    public function setTestsRealizados(?int $tests_realizados): self
    {
        $this->tests_realizados = $tests_realizados;

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

    public function getTipoUsuario(): ?string
    {
        return $this->tipo_usuario;
    }
    public function getTipo_Usuario(): ?string
    {
        return $this->tipo_usuario;
    }

    public function setTipoUsuario(string $tipo_usuario): self
    {
        $this->tipo_usuario = $tipo_usuario;

        return $this;
    }
    public function getUserName()
    {
        return $this->usuario;
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

    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): self
    {
        $this->contrasena = $contrasena;

        return $this;
    }
    public function getPassword()
    {
        return $this->contrasena;
    }
    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return array($this->tipo_usuario);
    }
    public function eraseCredentials()
    {

    }
    public function serialize()
    {
        return serialize(array($this->id,$this->usuario,$this->contrasena));
    }
    public function unserialize($datos_serializados)
    {
        list($this->id,$this->usuario,$this->contrasena)=
        unserialize($datos_serializados, array('allowed_classes' => false));
    }

    /**
     * @return Collection|Practicas[]
     */
    public function getPracticas(): Collection
    {
        return $this->practicas;
    }

    public function addPractica(Practicas $practica): self
    {
        if (!$this->practicas->contains($practica)) {
            $this->practicas[] = $practica;
            $practica->setIdUsuario($this);
        }

        return $this;
    }

    public function removePractica(Practicas $practica): self
    {
        if ($this->practicas->contains($practica)) {
            $this->practicas->removeElement($practica);
            // set the owning side to null (unless already changed)
            if ($practica->getIdUsuario() === $this) {
                $practica->setIdUsuario(null);
            }
        }

        return $this;
    }

    public function getPracticasRealizadas(): ?string
    {
        return $this->practicas_realizadas;
    }

    public function setPracticasRealizadas(?string $practicas_realizadas): self
    {
        $this->practicas_realizadas = $practicas_realizadas;

        return $this;
    }

}
