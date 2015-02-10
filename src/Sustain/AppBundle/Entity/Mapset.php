<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mapset
 *
 * @ORM\Table(name="mapset")
 * @ORM\Entity(repositoryClass="Sustain\AppBundle\Entity\MapsetRepository")
 */
class Mapset
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @ORM\OneToMany(targetEntity="Map", mappedBy="mapset")
     */
    protected $points;


    /**
     * @ORM\ManyToMany(targetEntity="Module", mappedBy="mapsets")
     */
    protected $modules;

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
     * Set name
     *
     * @param string $name
     * @return Mapset
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->points = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add points
     *
     * @param \Sustain\AppBundle\Entity\Map $points
     * @return Mapset
     */
    public function addPoint(\Sustain\AppBundle\Entity\Map $points)
    {
        $this->points[] = $points;

        return $this;
    }

    /**
     * Remove points
     *
     * @param \Sustain\AppBundle\Entity\Map $points
     */
    public function removePoint(\Sustain\AppBundle\Entity\Map $points)
    {
        $this->points->removeElement($points);
    }

    /**
     * Get points
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Mapset
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
     * Add modules
     *
     * @param \Sustain\AppBundle\Entity\Module $modules
     * @return Mapset
     */
    public function addModule(\Sustain\AppBundle\Entity\Module $modules)
    {
        $this->modules[] = $modules;

        return $this;
    }

    /**
     * Remove modules
     *
     * @param \Sustain\AppBundle\Entity\Module $modules
     */
    public function removeModule(\Sustain\AppBundle\Entity\Module $modules)
    {
        $this->modules->removeElement($modules);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModules()
    {
        return $this->modules;
    }
}
