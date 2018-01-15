<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 15.01.18
 * Time: 17:22
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employee")
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Position")
     * @ORM\JoinColumn(nullable=false)
     */
    private $position;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="date")
     */
    private $firstWorkingDayDate;

    /*public function __construct()
    {
        $this->position = new ArrayCollection();
    }*/

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    public function getFirstWorkingDayDate()
    {
        return $this->firstWorkingDayDate;
    }

    public function setFirstWorkingDayDate($firstWorkingDayDate)
    {
        $this->firstWorkingDayDate = $firstWorkingDayDate;
    }
}