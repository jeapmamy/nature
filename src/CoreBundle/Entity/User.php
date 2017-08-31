<?php
// src/CoreBundle/Entity/User.php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
* @ORM\Table(name="user")
* @ORM\Entity(repositoryClass="CoreBundle\Repository\UserRepository")
*/
class User extends BaseUser
{
	/**
	* @ORM\Column(name="id", type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	
	/**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Observation", mappedBy="user", cascade={"persist", "remove"})
     */
    private $observation;
	
	
	public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add observation
     *
     * @param \CoreBundle\Entity\Observation $observation
     *
     * @return User
     */
    public function addObservation(\CoreBundle\Entity\Observation $observation)
    {
        $this->observation[] = $observation;

        return $this;
    }

    /**
     * Remove observation
     *
     * @param \CoreBundle\Entity\Observation $observation
     */
    public function removeObservation(\CoreBundle\Entity\Observation $observation)
    {
        $this->observation->removeElement($observation);
    }

    /**
     * Get observation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservation()
    {
        return $this->observation;
    }
}
