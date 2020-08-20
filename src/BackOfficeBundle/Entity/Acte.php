<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acte
 *
 * @ORM\Table(name="acte")
 * @ORM\Entity
 */
class Acte
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
     * @var integer
     *
     * @ORM\Column(name="idsp", type="integer", nullable=false)
     */
    private $idsp;

    /**
     * @var string
     *
     * @ORM\Column(name="nomsp", type="string", length=200, nullable=false)
     */
    private $nomsp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="montant", type="integer", nullable=false)
     */
    private $montant;

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
     * @return int
     */
    public function getIdsp()
    {
        return $this->idsp;
    }

    /**
     * @param int $idsp
     */
    public function setIdsp($idsp)
    {
        $this->idsp = $idsp;
    }

    /**
     * @return string
     */
    public function getNomsp()
    {
        return $this->nomsp;
    }

    /**
     * @param string $nomsp
     */
    public function setNomsp($nomsp)
    {
        $this->nomsp = $nomsp;
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
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param int $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }





}

