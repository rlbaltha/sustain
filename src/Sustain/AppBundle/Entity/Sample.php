<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sample
 *
 * @ORM\Table(name="sample")
 * @ORM\Entity(repositoryClass="Sustain\AppBundle\Entity\SampleRepository")
 */
class Sample
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
     * @ORM\Column(name="facility", type="string", length=255)
     */
    private $facility;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_loc", type="string", length=255)
     */
    private $sysLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="param", type="string", length=255)
     */
    private $param;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="param_value", type="string", length=255)
     */
    private $paramValue;

    /**
     * @var string
     *
     * @ORM\Column(name="para_unit", type="string", length=255)
     */
    private $paraUnit;

    /**
     * @var string
     *
     * @ORM\Column(name="ebatch", type="string", length=255)
     */
    private $ebatch;

    /**
     * @var string
     *
     * @ORM\Column(name="task", type="string", length=255)
     */
    private $task;


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
     * Set facility
     *
     * @param string $facility
     * @return Sample
     */
    public function setFacility($facility)
    {
        $this->facility = $facility;

        return $this;
    }

    /**
     * Get facility
     *
     * @return string 
     */
    public function getFacility()
    {
        return $this->facility;
    }

    /**
     * Set sysLoc
     *
     * @param string $sysLoc
     * @return Sample
     */
    public function setSysLoc($sysLoc)
    {
        $this->sysLoc = $sysLoc;

        return $this;
    }

    /**
     * Get sysLoc
     *
     * @return string 
     */
    public function getSysLoc()
    {
        return $this->sysLoc;
    }

    /**
     * Set param
     *
     * @param string $param
     * @return Sample
     */
    public function setParam($param)
    {
        $this->param = $param;

        return $this;
    }

    /**
     * Get param
     *
     * @return string 
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Sample
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set paramValue
     *
     * @param string $paramValue
     * @return Sample
     */
    public function setParamValue($paramValue)
    {
        $this->paramValue = $paramValue;

        return $this;
    }

    /**
     * Get paramValue
     *
     * @return string 
     */
    public function getParamValue()
    {
        return $this->paramValue;
    }

    /**
     * Set paraUnit
     *
     * @param string $paraUnit
     * @return Sample
     */
    public function setParaUnit($paraUnit)
    {
        $this->paraUnit = $paraUnit;

        return $this;
    }

    /**
     * Get paraUnit
     *
     * @return string 
     */
    public function getParaUnit()
    {
        return $this->paraUnit;
    }

    /**
     * Set ebatch
     *
     * @param string $ebatch
     * @return Sample
     */
    public function setEbatch($ebatch)
    {
        $this->ebatch = $ebatch;

        return $this;
    }

    /**
     * Get ebatch
     *
     * @return string 
     */
    public function getEbatch()
    {
        return $this->ebatch;
    }

    /**
     * Set task
     *
     * @param string $task
     * @return Sample
     */
    public function setTask($task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return string 
     */
    public function getTask()
    {
        return $this->task;
    }
}
