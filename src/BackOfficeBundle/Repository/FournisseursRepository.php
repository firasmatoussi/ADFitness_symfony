<?php
/**
 * Created by PhpStorm.
 * User: pc-dell
 * Date: 26/12/2018
 * Time: 18:28
 */

namespace BackOfficeBundle\Repository;

use Doctrine\ORM\EntityRepository;
class FournisseursRepository extends EntityRepository
{
    public function findnom($q){

        return $this->getEntityManager()
            ->createQuery('select a from BackOfficeBundle:Fournisseurs a WHERE a.nom LIKE :b')
            ->setParameter('b','%'.$q.'%')
            ->getResult();
    }
}