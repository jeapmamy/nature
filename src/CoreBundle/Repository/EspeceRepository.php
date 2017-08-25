<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class EspeceRepository extends \Doctrine\ORM\EntityRepository
{
	public function listeNature($term)
    {
        $qb = $this->createQueryBuilder('c');
         
        $qb ->select('c.nomVern')
            
            ->where('c.nomVern LIKE :term')
            ->setParameter('term', '%'.$term.'%');
         
        $arrayAss= $qb->getQuery()
                   ->getArrayResult();
         
        // Transformer le tableau associatif en un tableau standard
        $array = array();
        foreach($arrayAss as $data)
        {
            $array[] = $data['nomVern'];
        }
     
        return $array;
    }
}
