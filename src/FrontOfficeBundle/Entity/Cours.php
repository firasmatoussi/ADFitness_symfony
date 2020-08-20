<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity
 */
class Cours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lib", type="string", length=25, nullable=false)
     */
    private $lib;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="salle", type="integer", nullable=false)
     */
    private $salle;

    /**
     * @var string
     *
     * @ORM\Column(name="coach_name", type="string", length=25, nullable=false)
     */
    private $coachName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_place", type="integer", nullable=false)
     */
    private $nbPlace;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLib()
    {
        return $this->lib;
    }

    /**
     * @param string $lib
     */
    public function setLib($lib)
    {
        $this->lib = $lib;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * @param int $salle
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;
    }

    /**
     * @return string
     */
    public function getCoachName()
    {
        return $this->coachName;
    }

    /**
     * @param string $coachName
     */
    public function setCoachName($coachName)
    {
        $this->coachName = $coachName;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * @param int $nbPlace
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;
    }




}

