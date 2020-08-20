<?php
/**
 * Created by PhpStorm.
 * User: pc-dell
 * Date: 31/12/2018
 * Time: 19:37
 */

namespace BackOfficeBundle\Repository;
use Doctrine\ORM\EntityRepository;

class EquipementsRepository extends EntityRepository
{
    public function findnom($q){

        return $this->getEntityManager()
            ->createQuery('select a from BackOfficeBundle:Equipements a WHERE a.libelle LIKE :b')
            ->setParameter('b','%'.$q.'%')
            ->getResult();
    }

}