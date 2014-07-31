<?php

namespace Kikala\FrontBundle\Entity;

use Doctrine\ORM\EntityRepository;

   /**
     * FormationRepository
     * Get the paginated list of published articles
     *
     * @param int $page
     * @param int $maxperpage
     * @param string $sortby
     * @return Paginator
     */
class FormationRepository extends EntityRepository

{
    public function getList($page=1, $maxperpage=30){
        $query = $this->createQueryBuilder('form')
            ->select('form')
            ->where ('form.dateFormation >= current_timestamp()')
            ->orderBy('form.dateFormation', 'ASC')
            ->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage)
        	->getQuery();
        $formations=$query->getResult();
        return $formations;
    }

    public function countFormation(){
		$count=$this->createQueryBuilder('name')
				->select('COUNT(name)')
				->getQuery()
				->getSingleScalarResult();
				return $count;

	}

    public function giveKikos(){
        $query = $this->createQueryBuilder('form')
            ->select('form')
            ->where ('form.dateFormation <= current_timestamp()')
            ->orderBy('form.dateFormation', 'ASC')
            ->getQuery();
        $pastformation=$query->getResult();
        return $pastformation;
    }

    public function countFormas($forma){
        $count=$this->createQueryBuilder('nb')
            ->select('COUNT(nb.formation)')
            ->where('nb.formation',$forma)
            ->getQuery()
            ->getSingleScalarResult();
            return $count;
    }

}

