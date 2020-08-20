<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productmagasin
 *
 * @ORM\Table(name="productmagasin")
 * @ORM\Entity
 */
class Productmagasin
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
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="Price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="Fabrication_date", type="string", length=50, nullable=false)
     */
    private $fabricationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="Expiration_date", type="string", length=50, nullable=false)
     */
    private $expirationDate;

    /**
     * @var float
     *
     * @ORM\Column(name="Amount", type="float", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="Cathegory", type="string", length=100, nullable=false)
     */
    private $cathegory;

    /**
     * @var integer
     *
     * @ORM\Column(name="StoreID", type="integer", nullable=false)
     */
    private $storeid;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="solde", type="integer", nullable=false)
     */
    private $solde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_ajout", type="date", nullable=false)
     */
    private $datAjout;


}

