<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaRepository")
 */
class Empresa
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dec_emp", type="string", length=255)
     */
    private $decEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="est_emp", type="integer")
     */
    private $estEmp;

    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="userEmpFk")
     */
    private $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="roomEmpFk")
     */
    private  $rooms;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set decEmp
     *
     * @param string $decEmp
     *
     * @return Empresa
     */
    public function setDecEmp($decEmp)
    {
        $this->decEmp = $decEmp;

        return $this;
    }

    /**
     * Get decEmp
     *
     * @return string
     */
    public function getDecEmp()
    {
        return $this->decEmp;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Empresa
     */
    public function addUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add room
     *
     * @param \AppBundle\Entity\Room $room
     *
     * @return Empresa
     */
    public function addRoom(\AppBundle\Entity\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \AppBundle\Entity\Room $room
     */
    public function removeRoom(\AppBundle\Entity\Room $room)
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set estEmp
     *
     * @param integer $estEmp
     *
     * @return Empresa
     */
    public function setEstEmp($estEmp)
    {
        $this->estEmp = $estEmp;

        return $this;
    }

    /**
     * Get estEmp
     *
     * @return integer
     */
    public function getEstEmp()
    {
        return $this->estEmp;
    }
}
