<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ModuleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ModuleRepository extends EntityRepository
{
    /**
     * Find modules by tag
     */
    public function modulesByTag($tag)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM AppBundle:Module m JOIN  m.tags t WHERE t.id = ?1 ')
            ->setParameter('1',$tag)->getResult();
    }
}
