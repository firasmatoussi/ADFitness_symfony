<?php

namespace BackOfficeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;



/**
 * PostLike
 *
 * @ORM\Table(name="postlike")
 * @ORM\Entity
 */
class PostLike
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
     *
     *@ORM\ManyToOne(targetEntity="ProductMagasin", inversedBy="likes")
     * @ORM\JoinColumn(name="productid", referencedColumnName="id")
     *
     */
    private $product;
    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }




}

