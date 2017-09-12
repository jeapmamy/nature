<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class EspeceRepository extends EntityRepository
{
	public function listeEspece($oiseau)
    {
        $qb = $this->createQueryBuilder('c');
         
        $qb ->select('c')
            
            ->where('c.nomVern LIKE :oiseau')
            ->setParameter('oiseau', '%'.$oiseau.'%');
         
        $arrayAss= $qb->getQuery()
                   ->getArrayResult();
         
        // Transformer le tableau associatif en un tableau standard
        $array = array();

        foreach($arrayAss as $data)
        {
            $array[] = $data;
        }
     
        return $array;
    }

    public function searchBird($id)
    {
        $select =  $this->createQueryBuilder('a')
         ->select ('a')
         ->where('a.id = :id')->setParameter('id', $id)
         ->getQuery()
         ->getScalarResult();
       return $select;
    }
	
	public function getEspeceWithObservation()
	{
		$qb = $this
			->createQueryBuilder('e')
			->leftJoin('e.observation', 'observ')
			->addSelect('observ')
		;

		return $qb
			->getQuery()
			->getResult()
		;
	}
}
