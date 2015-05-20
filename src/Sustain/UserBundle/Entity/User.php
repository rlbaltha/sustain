<?php

namespace Sustain\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="sustain_user")
 * @ORM\Entity(repositoryClass="Sustain\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="text", nullable=true)
     */
    private $bio;


    /**
     * @var string
     *
     * @ORM\Column(name="college", type="string", length=255, nullable=true)
     */
    private $college;

    /**
     * @var string
     *
     * @ORM\Column(name="research", type="text", nullable=true)
     */
    private $research;

    /**
     * @var string
     *
     * @ORM\Column(name="mentor", type="string", length=255, nullable=true)
     */
    private $mentor;

    /**
     * @var string
     *
     * @ORM\Column(name="studentid", type="string", length=255, nullable=true)
     */
    private $studentid;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\Page", mappedBy="user")
     */
    private $pages;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\File", mappedBy="user")
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\Map", mappedBy="user")
     */
    private $maps;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\Mapset", mappedBy="user")
     */
    private $mapsets;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\Module", mappedBy="user")
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\Objective", mappedBy="user")
     */
    private $objectives;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\Sample", mappedBy="user")
     */
    private $samples;

    /**
     * @ORM\OneToMany(targetEntity="Sustain\AppBundle\Entity\Activity", mappedBy="user")
     */
    private $activities;


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
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set bio
     *
     * @param string $bio
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string 
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set studentid
     *
     * @param string $studentid
     * @return User
     */
    public function setStudentid($studentid)
    {
        $this->studentid = $studentid;

        return $this;
    }

    /**
     * Get studentid
     *
     * @return string 
     */
    public function getStudentid()
    {
        return $this->studentid;
    }

    /**
     * Add pages
     *
     * @param \Sustain\AppBundle\Entity\Page $pages
     * @return User
     */
    public function addPage(\Sustain\AppBundle\Entity\Page $pages)
    {
        $this->pages[] = $pages;

        return $this;
    }

    /**
     * Remove pages
     *
     * @param \Sustain\AppBundle\Entity\Page $pages
     */
    public function removePage(\Sustain\AppBundle\Entity\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add files
     *
     * @param \Sustain\AppBundle\Entity\File $files
     * @return User
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
     * Add maps
     *
     * @param \Sustain\AppBundle\Entity\Map $maps
     * @return User
     */
    public function addMap(\Sustain\AppBundle\Entity\Map $maps)
    {
        $this->maps[] = $maps;

        return $this;
    }

    /**
     * Remove maps
     *
     * @param \Sustain\AppBundle\Entity\Map $maps
     */
    public function removeMap(\Sustain\AppBundle\Entity\Map $maps)
    {
        $this->maps->removeElement($maps);
    }

    /**
     * Get maps
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaps()
    {
        return $this->maps;
    }

    /**
     * Add mapsets
     *
     * @param \Sustain\AppBundle\Entity\Mapset $mapsets
     * @return User
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
     * Add modules
     *
     * @param \Sustain\AppBundle\Entity\Module $modules
     * @return User
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
     * Add objectives
     *
     * @param \Sustain\AppBundle\Entity\Objective $objectives
     * @return User
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
     * Add samples
     *
     * @param \Sustain\AppBundle\Entity\Sample $samples
     * @return User
     */
    public function addSample(\Sustain\AppBundle\Entity\Sample $samples)
    {
        $this->samples[] = $samples;

        return $this;
    }

    /**
     * Remove samples
     *
     * @param \Sustain\AppBundle\Entity\Sample $samples
     */
    public function removeSample(\Sustain\AppBundle\Entity\Sample $samples)
    {
        $this->samples->removeElement($samples);
    }

    /**
     * Get samples
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSamples()
    {
        return $this->samples;
    }



    /**
     * Add activities
     *
     * @param \Sustain\AppBundle\Entity\Activity $activities
     * @return User
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

    /**
     * Set research
     *
     * @param string $research
     * @return User
     */
    public function setResearch($research)
    {
        $this->research = $research;

        return $this;
    }

    /**
     * Get research
     *
     * @return string 
     */
    public function getResearch()
    {
        return $this->research;
    }

    /**
     * Set mentor
     *
     * @param string $mentor
     * @return User
     */
    public function setMentor($mentor)
    {
        $this->mentor = $mentor;

        return $this;
    }

    /**
     * Get mentor
     *
     * @return string 
     */
    public function getMentor()
    {
        return $this->mentor;
    }

    /**
     * Set college
     *
     * @param string $college
     * @return User
     */
    public function setCollege($college)
    {
        $this->college = $college;

        return $this;
    }

    /**
     * Get college
     *
     * @return string 
     */
    public function getCollege()
    {
        return $this->college;
    }
}
