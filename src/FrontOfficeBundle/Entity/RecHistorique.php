<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecHistorique
 *
 * @ORM\Table(name="rec_historique")
 * @ORM\Entity
 */
class RecHistorique
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


}

