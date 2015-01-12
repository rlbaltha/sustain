<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends EntityRepository
{
    public function findHome()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM AppBundle:Page p WHERE p.homepage = true ORDER BY p.updated DESC')->getResult();
    }
}
