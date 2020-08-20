<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Postlikea
 *
 * @ORM\Table(name="postlikea")
 * @ORM\Entity
 */
class Postlikea
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
     * @ORM\Column(name="idp", type="integer", nullable=false)
     */
    private $idp;

    /**
     * @var integer
     *
     * @ORM\Column(name="idu", type="integer", nullable=false)
     */
    private $idu;


}

