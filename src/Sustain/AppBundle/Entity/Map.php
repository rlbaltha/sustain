<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Map
 *
 * @ORM\Table(name="map")
 * @ORM\Entity(repositoryClass="Sustain\AppBundle\Entity\MapRepository")
 */
class Map
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=255)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=255)
     */
    private $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Mapset", inversedBy="points")
     */
    protected $mapset;

    /**
     * @ORM\ManyToOne(targetEntity="Sustain\UserBundle\Entity\User", inversedBy="maps")
     */
    protected $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Map
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set lat
     *
     * @param string $lat
     * @return Map
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     * @return Map
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string 
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Map
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set mapset
     *
     * @param \Sustain\AppBundle\Entity\Mapset $mapset
     * @return Map
     */
    public function setMapset(\Sustain\AppBundle\Entity\Mapset $mapset = null)
    {
        $this->mapset = $mapset;

        return $this;
    }

    /**
     * Get mapset
     *
     * @return \Sustain\AppBundle\Entity\Mapset 
     */
    public function getMapset()
    {
        return $this->mapset;
    }

    /**
     * Set user
     *
     * @param \Sustain\UserBundle\Entity\User $user
     * @return Map
     */
    public function setUser(\Sustain\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Sustain\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    public function isOwner($user)
    {
        if($user == $this->user){
            return true;
        }
        else{
            return false;
        }
    }
}
