<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 15.01.18
 * Time: 17:22
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="employee")
 * @ORM\HasLifecycleCallbacks()
 */
class Employee
{

    const SERVER_PATH_TO_IMAGE_FOLDER = '/var/www/web/uploads/photo';

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

    /**
     * Unmapped property to handle file uploads
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * Sets photo.
     *
     * @param UploadedFile $photo
     */
    public function setPhoto(UploadedFile $photo = null)
    {
        $this->photo = $photo;
    }

    /**
     * Get photo.
     *
     * @return UploadedFile
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getPhoto()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params
//        dump(self::SERVER_PATH_TO_IMAGE_FOLDER);die;
        $this->getPhoto()->move(
            self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getPhoto()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->filename = $this->getPhoto()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->setPhoto(null);
    }

    /**
     * @ORM\PostPersist
     * @ORM\PreUpdate
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }

    /**
     * Updates the hash value to force the preUpdate and postUpdate events to fire
     */
    public function refreshUpdated()
    {
        $this->setUpdated(new \DateTime());
    }

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

    public function __toString()
    {
        return $this->getFirstName() . $this->getLastName();
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;
    
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getWebPath()
    {
        return  '/uploads/photo/' . $this->getFilename();
    }
    
    public function getFilename()
    {
        return $this->filename;
    }
}