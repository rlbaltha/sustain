<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Sustain\AppBundle\Entity\PageRepository")
 */
class Page
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
     * @ORM\ManyToOne(targetEntity="Sustain\UserBundle\Entity\User", inversedBy="pages")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="menu_name", type="string", length=255)
     */
    private $menuName;

    /**
     * @var string
     *
     * @ORM\Column(name="teaser", type="text", nullable=true)
     */
    private $teaser;

    /**
     * @var string
     *
     * @ORM\Column(name="teaser_image", type="string", length=255, nullable=true)
     */
    private $teaserImage;

    /**
     * @var string
     *
     * @ORM\Column(name="teaser_image_caption", type="string", length=255, nullable=true)
     */
    private $teaserImageCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="page_body", type="text", nullable=true)
     */
    private $pageBody;


    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity="Section", inversedBy="pages")
     */
    protected $section;


    /**
     * @var integer $sortOrder
     *
     * @ORM\Column(name="sortorder", type="integer", nullable=true)
     */
    private $sortorder;


    /**
     * @var boolean $homepage
     *
     * @ORM\Column(name="homepage", type="boolean", nullable=true)
     */
    private $homepage = false;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;


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
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set menuName
     *
     * @param string $menuName
     * @return Page
     */
    public function setMenuName($menuName)
    {
        $this->menuName = $menuName;

        return $this;
    }

    /**
     * Get menuName
     *
     * @return string 
     */
    public function getMenuName()
    {
        return $this->menuName;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Page
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set pageBody
     *
     * @param string $pageBody
     * @return Page
     */
    public function setPageBody($pageBody)
    {
        $this->pageBody = $pageBody;

        return $this;
    }

    /**
     * Get pageBody
     *
     * @return string 
     */
    public function getPageBody()
    {
        return $this->pageBody;
    }

    /**
     * Set sortorder
     *
     * @param integer $sortorder
     * @return Page
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
     * Set created
     *
     * @param \DateTime $created
     * @return Page
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
     * @return Page
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
     * Add children
     *
     * @param \Sustain\AppBundle\Entity\Page $children
     * @return Page
     */
    public function addChild(\Sustain\AppBundle\Entity\Page $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Sustain\AppBundle\Entity\Page $children
     */
    public function removeChild(\Sustain\AppBundle\Entity\Page $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Sustain\AppBundle\Entity\Page $parent
     * @return Page
     */
    public function setParent(\Sustain\AppBundle\Entity\Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Sustain\AppBundle\Entity\Page 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set section
     *
     * @param \Sustain\AppBundle\Entity\Section $section
     * @return Page
     */
    public function setSection(\Sustain\AppBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Sustain\AppBundle\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set user
     *
     * @param \Sustain\UserBundle\Entity\User $user
     * @return Page
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

    /**
     * Set homepage
     *
     * @param boolean $homepage
     * @return Page
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return boolean 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set teaser
     *
     * @param string $teaser
     * @return Page
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;

        return $this;
    }

    /**
     * Get teaser
     *
     * @return string 
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * Set teaserImage
     *
     * @param string $teaserImage
     * @return Page
     */
    public function setTeaserImage($teaserImage)
    {
        $this->teaserImage = $teaserImage;

        return $this;
    }

    /**
     * Get teaserImage
     *
     * @return string 
     */
    public function getTeaserImage()
    {
        return $this->teaserImage;
    }

    /**
     * Set teaserImageCaption
     *
     * @param string $teaserImageCaption
     * @return Page
     */
    public function setTeaserImageCaption($teaserImageCaption)
    {
        $this->teaserImageCaption = $teaserImageCaption;

        return $this;
    }

    /**
     * Get teaserImageCaption
     *
     * @return string 
     */
    public function getTeaserImageCaption()
    {
        return $this->teaserImageCaption;
    }
}
