<?php

namespace CoreBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * ObservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObservationRepository extends EntityRepository
{

	// Depuis un repository
	public function mase($id)
	{
	  $query = $this->_em->createQuery('SELECT a.id, a.date, a.latitude, a.longitude FROM CoreBundle:Observation a ');
	  //$query->setParameter('id', $id);

	  $results = $query->getResult();

	  return $results;
	}

}