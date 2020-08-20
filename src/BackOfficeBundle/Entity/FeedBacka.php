<?php

namespace BackOfficeBundle\Entity;

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
     * @return int
     */
    public function getIdp()
    {
        return $this->idp;
    }

    /**
     * @param int $idp
     */
    public function setIdp($idp)
    {
        $this->idp = $idp;
    }

    /**
     * @return int
     */
    public function getIdu()
    {
        return $this->idu;
    }

    /**
     * @param int $idu
     */
    public function setIdu($idu)
    {
        $this->idu = $idu;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param string $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }


}

