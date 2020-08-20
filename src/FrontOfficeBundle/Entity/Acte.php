<?php

namespace FrontOfficeBundle\Entity;

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


}

