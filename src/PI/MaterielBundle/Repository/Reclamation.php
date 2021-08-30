<?php

/**
 * Created by PhpStorm.
 * User: balha
 * Date: 01/04/2017
 * Time: 00:21
 */
namespace PI\MaterielBundle\Repository;
use Doctrine\ORM\EntityRepository;

class Reclamation extends EntityRepository
{


    public function stat($b)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        SELECT COUNT (o.id) AS  sauto FROM MyAppUserBundle:Reclamation o WHERE o.etatReclamation = :b");
        $query->setParameter('b', $b);
        return $query->getSingleScalarResult() ;

    }
    public function statRef($a)
    {
        $query = $this->getEntityManager()
            ->createQuery("
        SELECT COUNT(o.id) AS  sauto FROM MyAppUserBundle:Reclamation o WHERE o.etatReclamation = :a");
        $query->setParameter('a', $a);
        return $query->getSingleScalarResult() ;

    }
    public function SearchAlerte($recherche)
    {

        $em= $this->getEntityManager();
        $query = $em->createQuery("SELECT a FROM MyAppUserBundle:Materiel a WHERE a.nom LIKE '$recherche%' or a.type LIKE '$recherche%' or a.prix LIKE '$recherche%'   ");


        return $query->getResult();

    }

}