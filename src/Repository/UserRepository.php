<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->add($user, true);
    }
    /**
     * recuperate Role
     *
     * @param [type] $role
     * @return array|null
     */
    public function findByRole($role): ?array
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles =:role')
            ->setParameter('role', $role)
            ->getQuery()
            ->getResult();
    }    
/**
* @return User[] Returns username and email
*/
public function findByWithQueryBuilder(string $username, string $email=null): ?User
{
    $queryBuilderUsername = $this->createQueryBuilder('u')
        ->where('u.username = :username')
        ->setParameter('username', $username)
        ->orderBy('u.id', 'DESC')
        ->setMaxResults(10)
    ;
    if($email !== null){
        $queryBuilderUsername
        ->andWhere('u.email = :email')
        ->setParameter('email',$email)
        ;
    } 
// getQuery=> recupere en objet
    $queryUsername = $queryBuilderUsername->getQuery();

//getResult= collection entity = vide ou 1 à n
//getOneOrNullresult = 1 ou aucun resultat
//getSingleresult = 1 seul resultat si 0 une exception lancé
    return $queryUsername->getResult();
    // return $queryUsername->getOneOrNullResult();
    
}
    // public function findAllUsers(): array
    //     {        
    //         $query = $this->getEntityManager()->createQuery("
    //             SELECT u 
    //             FROM App\Entity\User u 
    //             WHERE u.roles LIKE '%ROLE_PARTNER%' 
    //             OR u.roles LIKE '%ROLE_STRUCTURE%' 
    //         ");
    //         return $query->getResult();
    //     }
    

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}