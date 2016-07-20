<?php

namespace Openpp\MapBundle\Entity;

use Doctrine\Common\Persistence\ObjectManager;
use Openpp\MapBundle\Model\PointManager as BaseManager;

class PointManager extends BaseManager
{
    protected $objectManager;
    protected $repository;
    protected $class;

    /**
     * Constructor
     *
     * @param ObjectManager $om
     * @param string $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function createFromLonLat($longitude, $latitude)
    {
        $point = $this->create();
        $point->setPoint(new \CrEOF\Spatial\PHP\Types\Geometry\Point($longitude, $latitude));

        return $point;
    }
}