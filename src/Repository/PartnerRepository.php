<?php

namespace App\Repository;

use App\Entity\Partner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Partner>
 *
 * @method Partner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partner[]    findAll()
 * @method Partner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partner::class);
    }

    public function add(Partner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Partner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Return allPartner
     */
    public function findAllPartners(): ?array
    {
        return
        $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }

    /**
     * Return partner with name
     */
    public function findOneByName($name): array | Partner
    {
        return
        $this->createQueryBuilder('p')
            ->andWhere('p.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult();
    }

    /**
     * Pagination partner
     */
    public function getPaginatedPartner(int $page): array | Partner
    {
        $page = $_GET['page']?? 1;
        $partnerPerPage = 30;
        $qb =  $this->createQueryBuilder('p')
            ->orderBy('p.namePartner')
            ->setFirstResult(($page -1 ) * $partnerPerPage)
            ->setMaxResults($partnerPerPage);
            
        return $qb->getQuery()->getResult();
    }

    /**
     * Return count Partner
     */
    public function countPartners()
    {
        return $this->createQueryBuilder('p')
                    ->select('COUNT(p.id)')
                    ->getQuery()
                    ->getSingleScalarResult();
    }
    
    public function findIsActive($isActive)
    {
        return $this->createQueryBuilder('p')
                    ->select('p.isActive =:isActive')
                    ->setParameter('isActive', $isActive)
                    ->getQuery()
                    ->getResult();
    }
    
    // public function  findUser()
    // {
    //     return $this->createQueryBuilder('p')
    //                 ->select('p.user')
    //                 ->getQuery()
    //                 ->getOneOrNullResult();
    // }

//    /**
//     * @return Partner[] Returns an array of Partner objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Partner
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}