<?php



namespace PI\AmineBundle\Repository;
use Doctrine\ORM\EntityRepository;

class RandonneeRepository extends EntityRepository
{
    function findDQL()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT a FROM MyAppUserBundle:Randonnee a order by a.dateDebut ASC");

        return $query->getResult();

    }
    function rechDQL($niveau,$categorie,$lieu,$prix,$dateDebut)
    {

            $query=$this->getEntityManager()
                ->createQuery("select v from  MyAppUserBundle:Randonnee v where v.niveau=:niveau or v.categorie=:categorie
 or v.lieu=:lieu or v.prix=:prix or v.dateDebut=:dateDebut");
                $query->setParameters(array('niveau'=>$niveau,'categorie'=>$categorie,'lieu'=>$lieu,'prix'=>$prix,'dateDebut'=>$dateDebut));
            return $query->getResult();



    }

}