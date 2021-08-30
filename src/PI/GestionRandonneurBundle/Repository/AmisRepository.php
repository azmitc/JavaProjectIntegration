<?php
/**
 * Created by PhpStorm.
 * User: Amine
 * Date: 19/05/2017
 * Time: 18:38
 */

namespace PI\GestionRandonneurBundle\Repository;


class AmisRepository extends \Doctrine\ORM\EntityRepository
{
    public function AfficheAmiDuConnecte($recherche)
    {

        $em= $this->getEntityManager();
        $query = $em->createQuery("SELECT a FROM MyAppUserBundle:Amis a  WHERE a.nom ='$recherche'");


        return $query->getResult();

    }

}