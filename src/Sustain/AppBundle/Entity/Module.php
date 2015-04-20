<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="Sustain\AppBundle\Entity\ModuleRepository")
 */
class Module
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
     * @var integer
     *
     * @ORM\Column(name="sortorder", type="integer")
     */
    private $sortorder;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="File", mappedBy="modules")
     */
    protected $files;

    /**
     * @ORM\ManyToMany(targetEntity="Activity", mappedBy="modules")
     */
    protected $activities;

    /**
     * @ORM\ManyToMany(targetEntity="Objective", inversedBy="modules")
     */
    protected $objectives;

    /**
     * @ORM\ManyToMany(targetEntity="Mapset", inversedBy="modules")
     */
    protected $mapsets;

    /**
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="modules")
     */
    protected $theme;

    /**
     * @ORM\ManyToOne(targetEntity="Sustain\UserBundle\Entity\User", inversedBy="modules")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="modules")
     */
    protected $tags;

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
     * @return Module
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
     * Set sortorder
     *
     * @param integer $sortorder
     * @return Module
     */
    public function setSortorder($sortorder)
    {
        $this->sortorder = $sortorder;

        return $this;
    }

    /**
     * Get sortorder
     *
     * @return integer 
     */
    public function getSortorder()
    {
        return $this->sortorder;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * Add objectives
     *
     * @param \Sustain\AppBundle\Entity\Objective $objectives
     * @return Module
     */
    public function addObjective(\Sustain\AppBundle\Entity\Objective $objectives)
    {
        $this->objectives[] = $objectives;

        return $this;
    }

    /**
     * Remove objectives
     *
     * @param \Sustain\AppBundle\Entity\Objective $objectives
     */
    public function removeObjective(\Sustain\AppBundle\Entity\Objective $objectives)
    {
        $this->objectives->removeElement($objectives);
    }

    /**
     * Get objectives
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObjectives()
    {
        return $this->objectives;
    }

    /**
     * Add mapsets
     *
     * @param \Sustain\AppBundle\Entity\Mapset $mapsets
     * @return Module
     */
    public function addMapset(\Sustain\AppBundle\Entity\Mapset $mapsets)
    {
        $this->mapsets[] = $mapsets;

        return $this;
    }

    /**
     * Remove mapsets
     *
     * @param \Sustain\AppBundle\Entity\Mapset $mapsets
     */
    public function removeMapset(\Sustain\AppBundle\Entity\Mapset $mapsets)
    {
        $this->mapsets->removeElement($mapsets);
    }

    /**
     * Get mapsets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMapsets()
    {
        return $this->mapsets;
    }

    /**
     * Set user
     *
     * @param \Sustain\UserBundle\Entity\User $user
     * @return Module
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

    /**
     * Add tags
     *
     * @param \Sustain\AppBundle\Entity\Tag $tags
     * @return Module
     */
    public function addTag(\Sustain\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Sustain\AppBundle\Entity\Tag $tags
     */
    public function removeTag(\Sustain\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }



    /**
     * Add activities
     *
     * @param \Sustain\AppBundle\Entity\Activity $activities
     * @return Module
     */
    public function addActivity(\Sustain\AppBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \Sustain\AppBundle\Entity\Activity $activities
     */
    public function removeActivity(\Sustain\AppBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivities()
    {
        return $this->activities;
    }
}
