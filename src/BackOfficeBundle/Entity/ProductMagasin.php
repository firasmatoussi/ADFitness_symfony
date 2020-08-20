<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints\Date;





/**
 * ProductMagasin
 *
 * @ORM\Table(name="productmagasin")
 * @ORM\Entity
 */
class ProductMagasin
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
     * @ORM\Column(type="string")
     * @Assert\Image(
     *     minWidth = 100,
     *     maxWidth = 2000,
     *     minHeight = 100,
     *     maxHeight = 2000
     * )
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
     *
     * @var string $dat_ajout
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="dat_ajout", type="string")
     */
    private $dat_ajout;

    /**
     * ProductMagasin constructor.
     * @param string $name
     * @param float $price
     * @param int $quantity
     * @param string $fabricationDate
     * @param string $expirationDate
     * @param float $amount
     * @param string $cathegory
     * @param int $storeid
     * @param $image
     * @param string $description
     * @param int $solde
     * @param string $dat_ajout
     */
    public function __construct($name, $price, $quantity, $fabricationDate, $expirationDate, $amount, $cathegory, $storeid, $image, $description, $solde, $dat_ajout)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->fabricationDate = $fabricationDate;
        $this->expirationDate = $expirationDate;
        $this->amount = $amount;
        $this->cathegory = $cathegory;
        $this->storeid = $storeid;
        $this->image = $image;
        $this->description = $description;
        $this->solde = $solde;
        $this->dat_ajout = $dat_ajout;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getFabricationDate()
    {
        return $this->fabricationDate;
    }

    /**
     * @param string $fabricationDate
     */
    public function setFabricationDate($fabricationDate)
    {
        $this->fabricationDate = $fabricationDate;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCathegory()
    {
        return $this->cathegory;
    }

    /**
     * @param string $cathegory
     */
    public function setCathegory($cathegory)
    {
        $this->cathegory = $cathegory;
    }

    /**
     * @return int
     */
    public function getStoreid()
    {
        return $this->storeid;
    }

    /**
     * @param int $storeid
     */
    public function setStoreid($storeid)
    {
        $this->storeid = $storeid;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param int $solde
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;
    }

    /**
     * @return string
     */
    public function getDatAjout()
    {
        return $this->dat_ajout;
    }

    /**
     * @param string $dat_ajout
     */
    public function setDatAjout($dat_ajout)
    {
        $this->dat_ajout = $dat_ajout;
    }




}


