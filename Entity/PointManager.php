<?php

namespace Openpp\MapBundle\Entity;

use Doctrine\Common\Persistence\ManagerRegistry;
use Openpp\MapBundle\Model\PointManager as BaseManager;

class PointManager extends BaseManager
{
    protected $objectManager;
    protected $repository;
    protected $class;

    /**
     * Constructor
     *
     * @param ManagerRegistry $managerRegistry
     * @param string $class
     */
    public function __construct(ManagerRegistry $managerRegistry, $class)
    {
        $this->objectManager = $managerRegistry->getManagerForClass($class);
        $this->repository = $this->objectManager->getRepository($class);

        $metadata = $this->objectManager->getClassMetadata($class);
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