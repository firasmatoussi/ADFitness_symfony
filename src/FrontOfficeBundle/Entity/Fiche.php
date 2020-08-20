<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fiche
 *
 * @ORM\Table(name="fiche")
 * @ORM\Entity
 */
class Fiche
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
     * @ORM\Column(name="idclient", type="integer", nullable=false)
     */
    private $idclient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="naissance", type="date", nullable=false)
     */
    private $naissance;

    /**
     * @var boolean
     *
     * @ORM\Column(name="diabete", type="boolean", nullable=false)
     */
    private $diabete;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hypo", type="boolean", nullable=false)
     */
    private $hypo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hyper", type="boolean", nullable=false)
     */
    private $hyper;

    /**
     * @var boolean
     *
     * @ORM\Column(name="perte", type="boolean", nullable=false)
     */
    private $perte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="saignement", type="boolean", nullable=false)
     */
    private $saignement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fumeur", type="boolean", nullable=false)
     */
    private $fumeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pratiquant", type="boolean", nullable=false)
     */
    private $pratiquant;

    /**
     * @var boolean
     *
     * @ORM\Column(name="perdre", type="boolean", nullable=false)
     */
    private $perdre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="strength", type="boolean", nullable=false)
     */
    private $strength;


}

