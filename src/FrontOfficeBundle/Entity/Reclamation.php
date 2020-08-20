<?php

namespace FrontOfficeBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=false)
     */
    private $exp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat", type="datetime", nullable=false)
     */
    private $dat = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="tex", type="string", length=255, nullable=false)
     */
    private $tex;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255, nullable=false)
     */
    private $reponse;


}

