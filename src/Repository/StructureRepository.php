<?php

namespace App\Repository;

use App\Entity\Permission;
use App\Entity\Structure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Structure>
 *
 * @method Structure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Structure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Structure[]    findAll()
 * @method Structure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Structure::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Structure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Structure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Return all structures
     */
    public function findAllStructures(): ?array
    {
        return
        $this->createQueryBuilder('s')
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Return all structures by partner
     */
    public function findAllStructuresByPartner($id) :?array
    {
        return $this->createQueryBuilder('s')
                    ->where('s.partner = :id')
                    ->setParameter('id', $id)
                    ->orderBy('s.nameStructure')
                    ->getQuery()
                    ->getResult();
    }

    /**
     * Return Structure with name
     */
    public function findOneByName($name): array | Structure
    {
        return
            $this->createQueryBuilder('s')
            ->andWhere('s.nameStructure = :nameStructure')
            ->setParameter('nameStructure', $name)
            ->getQuery()
            ->getResult();
    }

    /**
     * Pagination structure
     */
    public function getPaginatedStructure(int $page): array | Structure
    {
        $page = $_GET['page'] ?? 1;
        $structurePerPage = 30;
        $qb =  $this->createQueryBuilder('s')
            ->orderBy('s.nameStructure')
            ->setFirstResult(($page - 1) * $structurePerPage)
            ->setMaxResults($structurePerPage);

        return $qb->getQuery()->getResult();
    }

    /**
     * Return count Structure
     */
    public function countStructures()
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    
//    /**
//     * @return Structure[] Returns an array of Structure objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Structure
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}