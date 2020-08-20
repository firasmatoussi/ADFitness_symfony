<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Postlike
 *
 * @ORM\Table(name="postlike", indexes={@ORM\Index(name="IDX_E10B1952A3FDB2A7", columns={"productid"}), @ORM\Index(name="IDX_E10B1952F132696E", columns={"userid"})})
 * @ORM\Entity
 */
class Postlike
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

