<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario
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
     * @ORM\Column(name="nom_user", type="string", length=50)
     */
    private $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="app_user", type="string", length=50)
     */
    private $appUser;

    /**
     * @var string
     *
     * @ORM\Column(name="ced_user", type="string", length=13, nullable=true, unique=true)
     */
    private $cedUser;

    /**
     * @var string
     *
     * @ORM\Column(name="email_user", type="string", length=150, unique=true)
     */
    private $emailUser;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="Usuario")
     * @ORM\JoinColumn(name="userEmpFk", referencedColumnName="id")
     */
    private $userEmpFk;

    /**
     * @ORM\OneToMany(targetEntity="Reservas", mappedBy="userResFk")
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
     * Set nomUser
     *
     * @param string $nomUser
     *
     * @return Usuario
     */
    public function setNomUser($nomUser)
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    /**
     * Get nomUser
     *
     * @return string
     */
    public function getNomUser()
    {
        return $this->nomUser;
    }

    /**
     * Set appUser
     *
     * @param string $appUser
     *
     * @return Usuario
     */
    public function setAppUser($appUser)
    {
        $this->appUser = $appUser;

        return $this;
    }

    /**
     * Get appUser
     *
     * @return string
     */
    public function getAppUser()
    {
        return $this->appUser;
    }

    /**
     * Set cedUser
     *
     * @param string $cedUser
     *
     * @return Usuario
     */
    public function setCedUser($cedUser)
    {
        $this->cedUser = $cedUser;

        return $this;
    }

    /**
     * Get cedUser
     *
     * @return string
     */
    public function getCedUser()
    {
        return $this->cedUser;
    }

    /**
     * Set emailUser
     *
     * @param string $emailUser
     *
     * @return Usuario
     */
    public function setEmailUser($emailUser)
    {
        $this->emailUser = $emailUser;

        return $this;
    }

    /**
     * Get emailUser
     *
     * @return string
     */
    public function getEmailUser()
    {
        return $this->emailUser;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set userEmpFk
     *
     * @param \AppBundle\Entity\Empresa $userEmpFk
     *
     * @return Usuario
     */
    public function setUserEmpFk(\AppBundle\Entity\Empresa $userEmpFk = null)
    {
        $this->userEmpFk = $userEmpFk;

        return $this;
    }

    /**
     * Get userEmpFk
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getUserEmpFk()
    {
        return $this->userEmpFk;
    }

    /**
     * Add reserva
     *
     * @param \AppBundle\Entity\Reservas $reserva
     *
     * @return Usuario
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
}
