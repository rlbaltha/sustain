<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objective
 *
 * @ORM\Table(name="objective")
 * @ORM\Entity(repositoryClass="Sustain\AppBundle\Entity\ObjectiveRepository")
 */
class Objective
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
     * @ORM\Column(name="objective", type="text")
     */
    private $objective;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="File", mappedBy="objectives")
     */
    protected $files;

    /**
     * @ORM\ManyToMany(targetEntity="Module", mappedBy="objectives")
     */
    protected $modules;

    /**
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="objectives")
     */
    protected $theme;

    /**
     * @ORM\ManyToOne(targetEntity="Sustain\UserBundle\Entity\User", inversedBy="objectives")
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
     * Set objective
     *
     * @param string $objective
     * @return Objective
     */
    public function setObjective($objective)
    {
        $this->objective = $objective;

        return $this;
    }

    /**
     * Get objective
     *
     * @return string 
     */
    public function getObjective()
    {
        return $this->objective;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Objective
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
     * Constructor
     */
    public function __construct()
    {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add files
     *
     * @param \Sustain\AppBundle\Entity\File $files
     * @return Objective
     */
    public function addFile(\Sustain\AppBundle\Entity\File $files)
    {
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files
     *
     * @param \Sustain\AppBundle\Entity\File $files
     */
    public function removeFile(\Sustain\AppBundle\Entity\File $files)
    {
        $this->files->removeElement($files);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set theme
     *
     * @param \Sustain\AppBundle\Entity\Theme $theme
     * @return Objective
     */
    public function setTheme(\Sustain\AppBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Sustain\AppBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }



    /**
     * Add modules
     *
     * @param \Sustain\AppBundle\Entity\Module $modules
     * @return Objective
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

    /**
     * Set user
     *
     * @param \Sustain\UserBundle\Entity\User $user
     * @return Objective
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
}
