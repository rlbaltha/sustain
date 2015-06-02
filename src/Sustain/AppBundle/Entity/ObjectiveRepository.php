<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ObjectiveRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObjectiveRepository extends EntityRepository
{
    /**
     * Find objectives by tag
     */
    public function objectivesByTag($tag)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT o FROM AppBundle:Objective o JOIN  o.tags t WHERE t.id = ?1 ')
            ->setParameter('1',$tag)->getResult();
    }
}
