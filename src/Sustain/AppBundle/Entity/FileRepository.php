<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FileRepository extends EntityRepository
{
    /**
     * Find files by tag
     * @return File
     */
    public function filesByTag($tag) {

        return $this->createQueryBuilder('f')
            ->leftJoin('f.tags','t')
            ->addSelect('t')
            ->andWhere('t.id = :tag')
            ->setParameter('tag',$tag)
            ->addOrderBy('f.name','ASC')
            ->getQuery()
            ->getResult();

    }

    /**
     * Find files by tag
     * @return File
     */
    public function findAllSorted() {

        return $this->createQueryBuilder('f')
            ->andWhere('f.access < 2')
            ->addOrderBy('f.name','ASC')
            ->getQuery()
            ->getResult();

    }

    /**
     * Find files by tag
     * @return File
     */
    public function findAdmin() {

        return $this->createQueryBuilder('f')
            ->andWhere('f.access = 2')
            ->addOrderBy('f.name','ASC')
            ->getQuery()
            ->getResult();

    }
}
