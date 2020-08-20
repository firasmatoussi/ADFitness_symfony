<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback", indexes={@ORM\Index(name="IDX_D2294458A3FDB2A7", columns={"productid"}), @ORM\Index(name="IDX_D2294458F132696E", columns={"userid"})})
 * @ORM\Entity
 */
class Feedback
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

    /**
     * @var \Productmagasin
     *
     * @ORM\ManyToOne(targetEntity="Productmagasin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="productid", referencedColumnName="id")
     * })
     */
    private $productid;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userid", referencedColumnName="id")
     * })
     */
    private $userid;


}

