<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
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
     * @ORM\Column(name="des_room", type="string", length=150)
     */
    private $desRoom;

    /**
     * @var string
     *
     * @ORM\Column(name="obs_room", type="text" , nullable=true)
     */
    private $ObsRoom;



    /**
     * @var int
     *
     * @ORM\Column(name="cap_room", type="integer", nullable=true)
     */
    private $capRoom;

    /**
     * @var int
     *
     * @ORM\Column(name="est_room", type="integer")
     */
    private $estRoom;


    /**
     * @var string
     *
     * @ORM\Column(name="tip_room", type="string", length=4)
     */
    private $tipRoom;


    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="Room")
     * @ORM\JoinColumn(name="roomEmpFk", referencedColumnName="id")
     */
    private $roomEmpFk;

    /**
     * @ORM\OneToMany(targetEntity="Reservas", mappedBy="roomResFk")
     */
    private  $reservas;
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
     * Set desRoom
     *
     * @param string $desRoom
     *
     * @return Room
     */
    public function setDesRoom($desRoom)
    {
        $this->desRoom = $desRoom;

        return $this;
    }

    /**
     * Get desRoom
     *
     * @return string
     */
    public function getDesRoom()
    {
        return $this->desRoom;
    }

    /**
     * Set capRoom
     *
     * @param integer $capRoom
     *
     * @return Room
     */
    public function setCapRoom($capRoom)
    {
        $this->capRoom = $capRoom;

        return $this;
    }

    /**
     * Get capRoom
     *
     * @return int
     */
    public function getCapRoom()
    {
        return $this->capRoom;
    }

    /**
     * Set tipRoom
     *
     * @param string $tipRoom
     *
     * @return Room
     */
    public function setTipRoom($tipRoom)
    {
        $this->tipRoom = $tipRoom;

        return $this;
    }

    /**
     * Get tipRoom
     *
     * @return string
     */
    public function getTipRoom()
    {
        return $this->tipRoom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set roomEmpFk
     *
     * @param \AppBundle\Entity\Empresa $roomEmpFk
     *
     * @return Room
     */
    public function setRoomEmpFk(\AppBundle\Entity\Empresa $roomEmpFk = null)
    {
        $this->roomEmpFk = $roomEmpFk;

        return $this;
    }

    /**
     * Get roomEmpFk
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getRoomEmpFk()
    {
        return $this->roomEmpFk;
    }

    /**
     * Add reserva
     *
     * @param \AppBundle\Entity\Reservas $reserva
     *
     * @return Room
     */
    public function addReserva(\AppBundle\Entity\Reservas $reserva)
    {
        $this->reservas[] = $reserva;

        return $this;
    }

    /**
     * Remove reserva
     *
     * @param \AppBundle\Entity\Reservas $reserva
     */
    public function removeReserva(\AppBundle\Entity\Reservas $reserva)
    {
        $this->reservas->removeElement($reserva);
    }

    /**
     * Get reservas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservas()
    {
        return $this->reservas;
    }
    /**
     * @return int
     */
    public function getEstRoom()
    {
        return $this->estRoom;
    }

    /**
     * @param int $estRoom
     */
    public function setEstRoom($estRoom)
    {
        $this->estRoom = $estRoom;
    }

    /**
     * @return string
     */
    public function getObsRoom()
    {
        return $this->ObsRoom;
    }

    /**
     * @param string $ObsRoom
     */
    public function setObsRoom($ObsRoom)
    {
        $this->ObsRoom = $ObsRoom;
    }
}
