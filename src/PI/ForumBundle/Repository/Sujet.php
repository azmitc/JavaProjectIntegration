<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/04/2017
 * Time: 07:00
 */

namespace PI\ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;
class Sujet extends EntityRepository
{
    public function reche($recherche)
    {

        $em= $this->getEntityManager();
        $query = $em->createQuery("SELECT c FROM MyAppUserBundle:Sujet c WHERE c.titre LIKE '$recherche%' or c.nameUser LIKE '$recherche%'  ");
        return $query->getResult();

    }
}