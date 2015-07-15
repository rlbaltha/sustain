<?php

namespace Sustain\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MapRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MapRepository extends EntityRepository
{

    /**
     * Return map points by mapset for json
     *
     * @return Map
     */
    public function map_json($map) {
        $qb = $this->createQueryBuilder('m')
            ->select('m.lat as latitude, m.lng as longitude, m.title, m.description as content')
            ->where('m.mapset = :map')
            ->setParameter('map', $map);
        return $qb->getQuery()->getResult();
    }
    /**
     * Return map points by mapset
     *
     * @return Map
     */
    public function findBySet($id)
    {
        $qb = $this ->createQueryBuilder('m')
            ->where('m.mapset = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();

    }
}
