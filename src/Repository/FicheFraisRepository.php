<?php

namespace App\Repository;

use App\Entity\FicheFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Visiteur;

/**
 * @method FicheFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheFrais[]    findAll()
 * @method FicheFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheFraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheFrais::class);
    }

    // /**
    //  * @return FicheFrais[] Returns an array of FicheFrais objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheFrais
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function getUneFicheFrais($id,$mois)
{

$qb = $this->_em->createQueryBuilder();
$qb->select('a')
->from(FicheFrais::class,'a')
->where('a.idVisiteur = :id' )
->setParameter('id', $id)
->andWhere('a.mois =:mois')
->setParameter('mois', $mois);
$query = $qb->getQuery();
$result = $query->getOneOrNullResult();
return $result;
}
public function findAllFrais()
{

    $qb = $this->_em->createQueryBuilder();
    $qb->select('a')
    ->from(FicheFrais::class,'a')
            ;
    $query = $qb->getQuery();
    $result = $query->getResult();
return $result;
}
}
