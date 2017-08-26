<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class EspeceRepository extends EntityRepository
{
	public function listeNature($company)
    {
        $qb = $this->createQueryBuilder('c');
         
        $qb ->select('c.nomVern, c.lbAuteur')
            
            ->where('c.nomVern LIKE :company')
            ->setParameter('company', '%'.$company.'%');
         
        $arrayAss= $qb->getQuery()
                   ->getArrayResult();
         
        // Transformer le tableau associatif en un tableau standard
        $array = array();

        foreach($arrayAss as $data)
        {
            $data = $data['nomVern'] .", ". $data['lbAuteur'];
            $array[] = $data;
        }
     
        return $array;
    }
}
