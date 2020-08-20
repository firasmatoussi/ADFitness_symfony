<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
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
     * @ORM\Column(name="lib", type="string", length=50, nullable=false)
     */
    private $lib;

    /**
     * @var string
     *
     * @ORM\Column(name="exp", type="string", length=100, nullable=false)
     */
    private $exp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat", type="datetime", nullable=false)
     */
    private $dat;

    /**
     * @var string
     *
     * @ORM\Column(name="tex", type="string", length=255, nullable=false)
     */
    private $tex;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255, nullable=false)
     */
    private $reponse;

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
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @param string $exp
     */
    public function setExp($exp)
    {
        $this->exp = $exp;
    }

    /**
     * @return \DateTime
     */
    public function getDat()
    {
        return $this->dat;
    }

    /**
     * @param \DateTime $dat
     */
    public function setDat($dat)
    {
        $this->dat = $dat;
    }

    /**
     * @return string
     */
    public function getTex()
    {
        return $this->tex;
    }

    /**
     * @param string $tex
     */
    public function setTex($tex)
    {
        $this->tex = $tex;
    }

    /**
     * @return bool
     */
    public function isEtat()
    {
        return $this->etat;
    }

    /**
     * @param bool $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param string $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }


}

