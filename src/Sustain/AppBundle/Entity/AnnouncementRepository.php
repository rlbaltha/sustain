<?php

namespace Sustain\AppBundle\Entity;

/**
 * AnnouncementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnouncementRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find announcement
     * @return Announcement
     */
    public function findAnnouncement()
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getSingleResult();
    }
}
