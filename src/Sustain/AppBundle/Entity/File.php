<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="Sustain\AppBundle\Entity\FileRepository")
 * @Vich\Uploadable
 */
class File
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
     * @Assert\File(
     *     maxSize="50M",
     *     mimeTypes={"audio/mpeg", "application/vnd.ms-office", "image/gif", "image/png", "image/jpeg", "image/pjpeg", "application/pdf",
     * "application/vnd.oasis.opendocument.text", "application/vnd.oasis.opendocument.presentation",
     * "application/vnd.oasis.opendocument.spreadsheet", "application/msword", "application/mspowerpoint",
     * "application/excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
     * "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     * "application/zip"}
     * )
     * @Vich\UploadableField(mapping="property_file", fileNameProperty="path")
     *
     * @var File $file
     */
    protected $file;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path = 'test';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="access", type="integer")
     */
    private $access = 0 ;

    /**
     * @var integer
     *
     * @ORM\Column(name="core", type="integer")
     */
    private $core = 0 ;    

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;


    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Sustain\UserBundle\Entity\User", inversedBy="files")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Module", inversedBy="files")
     */
    protected $modules;

    /**
     * @ORM\ManyToMany(targetEntity="Objective", inversedBy="files")
     */
    protected $objectives;
    
    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="files")
     */
    protected $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->objectives = new ArrayCollection();
    }


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
     * Set file
     *
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Return the extention of the file.
     *
     * @return string
     */
    public function getExt()
    {
        $filename = $this->getPath();
        return pathinfo($filename, PATHINFO_EXTENSION);
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
     * Set name
     *
     * @param string $name
     * @return File
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
     * Set path
     *
     * @param string $path
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return File
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set access
     *
     * @param integer $access
     * @return File
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return integer 
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return File
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return File
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
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
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add modules
     *
     * @param \Sustain\AppBundle\Entity\Module $modules
     * @return File
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
     * Add tags
     *
     * @param \Sustain\AppBundle\Entity\Tag $tags
     * @return File
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
     * Add objectives
     *
     * @param \Sustain\AppBundle\Entity\Objective $objectives
     * @return File
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
     * Set user
     *
     * @param \Sustain\UserBundle\Entity\User $user
     * @return File
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
     * Set core
     *
     * @param integer $core
     * @return File
     */
    public function setCore($core)
    {
        $this->core = $core;

        return $this;
    }

    /**
     * Get core
     *
     * @return integer 
     */
    public function getCore()
    {
        return $this->core;
    }
}
