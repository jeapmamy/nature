<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
	public function myFindBy()
	{
		
		$qb = $this->createQueryBuilder('u');

		$qb->where('u.pro = 1')
			
		;

		return $qb
			->getQuery()
			->getResult()
		;
	}
}
