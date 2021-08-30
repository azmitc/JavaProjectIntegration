<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09/04/2017
 * Time: 20:20
 */

namespace PI\ForumBundle\Repository;


namespace PI\ForumBundle\Repository;
use Doctrine\ORM\EntityRepository;

class Note extends EntityRepository
{
    public function MoyNote($id)
    {
        $query = $this->getEntityManager()
            ->createQuery("select AVG(n.note) from MyAppUserBundle:Note n WHERE n.idRando=:b");
        $query->setParameter('b', $id);
        return $query->getSingleScalarResult();

    }
}