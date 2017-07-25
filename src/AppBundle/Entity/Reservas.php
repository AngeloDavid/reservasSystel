<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservas
 *
 * @ORM\Table(name="reservas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservasRepository")
 */
class Reservas
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
     * @var \DateTime
     *
     * @ORM\Column(name="day_res", type="date")
     */
    private $dayRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaIn_res", type="time")
     */
    private $horaInRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaFin_res", type="time")
     */
    private $horaFinRes;

    /**
     * @var string
     *
     * @ORM\Column(name="obse_res", type="text")
     */
    private $obseRes;

    /**
     * @var string
     *
     * @ORM\Column(name="tip_res", type="string", length=10)
     */
    private $tipRes;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="Reservas")
     * @ORM\JoinColumn(name="userResFk", referencedColumnName="id")
     */
    private $userResFk;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="Reservas")
     * @ORM\JoinColumn(name="roomResFk", referencedColumnName="id")
     */
    private $roomResFk;

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
     * Set dayRes
     *
     * @param \DateTime $dayRes
     *
     * @return Reservas
     */
    public function setDayRes($dayRes)
    {
        $this->dayRes = $dayRes;

        return $this;
    }

    /**
     * Get dayRes
     *
     * @return \DateTime
     */
    public function getDayRes()
    {
        return $this->dayRes;
    }

    /**
     * Set horaInRes
     *
     * @param \DateTime $horaInRes
     *
     * @return Reservas
     */
    public function setHoraInRes($horaInRes)
    {
        $this->horaInRes = $horaInRes;

        return $this;
    }

    /**
     * Get horaInRes
     *
     * @return \DateTime
     */
    public function getHoraInRes()
    {
        return $this->horaInRes;
    }

    /**
     * Set horaFinRes
     *
     * @param \DateTime $horaFinRes
     *
     * @return Reservas
     */
    public function setHoraFinRes($horaFinRes)
    {
        $this->horaFinRes = $horaFinRes;

        return $this;
    }

    /**
     * Get horaFinRes
     *
     * @return \DateTime
     */
    public function getHoraFinRes()
    {
        return $this->horaFinRes;
    }

    /**
     * Set obseRes
     *
     * @param string $obseRes
     *
     * @return Reservas
     */
    public function setObseRes($obseRes)
    {
        $this->obseRes = $obseRes;

        return $this;
    }

    /**
     * Get obseRes
     *
     * @return string
     */
    public function getObseRes()
    {
        return $this->obseRes;
    }

    /**
     * Set tipRes
     *
     * @param string $tipRes
     *
     * @return Reservas
     */
    public function settipRes($tipRes)
    {
        $this->tipRes = $tipRes;

        return $this;
    }

    /**
     * Get tipRes
     *
     * @return string
     */
    public function gettipRes()
    {
        return $this->tipRes;
    }

    /**
     * Set userResFk
     *
     * @param \AppBundle\Entity\Usuario $userResFk
     *
     * @return Reservas
     */
    public function setUserResFk(\AppBundle\Entity\Usuario $userResFk = null)
    {
        $this->userResFk = $userResFk;

        return $this;
    }

    /**
     * Get userResFk
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUserResFk()
    {
        return $this->userResFk;
    }

    /**
     * Set roomResFk
     *
     * @param \AppBundle\Entity\Room $roomResFk
     *
     * @return Reservas
     */
    public function setRoomResFk(\AppBundle\Entity\Room $roomResFk = null)
    {
        $this->roomResFk = $roomResFk;

        return $this;
    }

    /**
     * Get roomResFk
     *
     * @return \AppBundle\Entity\Room
     */
    public function getRoomResFk()
    {
        return $this->roomResFk;
    }
}
