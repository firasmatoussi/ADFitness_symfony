<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * assurance
 *
 * @ORM\Table(name="assurance")
 * @ORM\Entity
 */
class Assurance
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
     * @ORM\Column(name="idu", type="integer", nullable=false)
     */
    private $idu;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255, nullable=false)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="companie", type="string", length=255, nullable=false)
     */
    private $companie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire", type="date", nullable=false)
     */
    private $expire;

    /**
     * @return int
     */
    public function getIdu()
    {
        return $this->idu;
    }

    /**
     * @param int $idu
     */
    public function setIdu($idu)
    {
        $this->idu = $idu;
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * @return string
     */
    public function getCompanie()
    {
        return $this->companie;
    }

    /**
     * @param string $companie
     */
    public function setCompanie($companie)
    {
        $this->companie = $companie;
    }

    /**
     * @return \DateTime
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param \DateTime $expire
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




}

