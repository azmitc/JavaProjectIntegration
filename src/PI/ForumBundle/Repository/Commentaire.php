<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 09/04/2017
 * Time: 19:28
 */

namespace PI\ForumBundle\Repository;
use Doctrine\ORM\EntityRepository;
class Commentaire extends EntityRepository
{
    public function CountCom()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(c.idCom) AS  com FROM MyAppUserBundle:Commentaire c WHERE c.signals = 1");
        return $query->getSingleScalarResult() ;

    }

    public function rech($recherche)
    {

        $em= $this->getEntityManager();
        $query = $em->createQuery("SELECT c FROM MyAppUserBundle:Commentaire c WHERE c.text LIKE '$recherche%' or c.userId LIKE '$recherche%'  ");
        return $query->getResult();

    }

    /*public function recherchevalideCarte($numRecharge)
    {s
        $query = $this->getEntityManager()
            ->createQuery("
        select (s.valide)  from MyAppCarteBundle:Recharge s where s.numRecharge=:numRecharge");
        $query->setParameter('numRecharge', $numRecharge);
        return $query->getSingleScalarResult();

    }

    public function modif($numRecharge)
    {
        $query = $this->getEntityManager()->createQuery(
            'update MyAppCarteBundle:Recharge p set p.valide=:b where p.numRecharge=:numRecharge');

        $query->setParameter('b', '1');
        $query->setParameter('numRecharge', $numRecharge);


        $query->execute();


    }*/
}