<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedbacka
 *
 * @ORM\Table(name="feedbacka")
 * @ORM\Entity
 */
class Feedbacka
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

    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float", precision=10, scale=0, nullable=false)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="feedback", type="string", length=500, nullable=false)
     */
    private $feedback;


}

