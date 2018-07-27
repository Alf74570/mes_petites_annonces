<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }


    public function findByKeyword($value)
    {
        if($value == ""){
            $value = null;
        }

        $qb = $this->createQueryBuilder('a')
            ->select('a');

        if($value) {
            $qb->andWhere('a.title LIKE :keyWord');
        }

        $qb->setParameter('keyWord' , '%'.$value.'%' );

        return  $qb->getQuery()->getResult();
    }

    public function findByCategoryCountryTitleUsername($value)
    {
        if ($value['search'] == "") {
            $value['search'] = null;
        }
        if ($value['category'] == "") {
            $value['category'] = null;
        }
        if ($value['country'] == "") {
            $value['country'] = null;
        }
        if ($value['author'] == "") {
            $value['author'] = null;
        }


        $qb = $this->createQueryBuilder('a')
            ->select('category')
            ->select('country')
            ->select('a')
            ->join('a.author', 'auth');

        if ($value['category']) {
            $qb->andWhere('category = :catName')
                ->setParameter('catName', $value['category']);
        }
        if ($value['country']) {
            $qb->andWhere('country = :regName');
            $qb->setParameter('regName', $value['country']);
        }
        if ($value['search']) {
            $qb->andWhere('a.title LIKE :keyWord');
            $qb->setParameter('keyWord', '%' . $value['search'] . '%');
        }
        if ($value['author']) {
            $qb->andWhere('auth.id = :regUsername');
            $qb->setParameter('regUsername', $value['author']);
        }
        return $qb->getQuery()->getResult();
    }








//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ad
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
