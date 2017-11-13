<?php

namespace Openpp\MapBundle\Entity;

use Doctrine\Common\Persistence\ManagerRegistry;
use Openpp\MapBundle\Model\PointManager as BaseManager;

class PointManager extends BaseManager
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Initializes a new PointManager.
     *
     * @param ManagerRegistry $managerRegistry
     * @param string          $class
     */
    public function __construct(ManagerRegistry $managerRegistry, $class)
    {
        $this->objectManager = $managerRegistry->getManagerForClass($class);
        $this->repository = $this->objectManager->getRepository($class);

        $metadata = $this->objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritdoc}
     */
    public function createFromLonLat($longitude, $latitude)
    {
        $point = $this->create();
        $point->setPoint(new \CrEOF\Spatial\PHP\Types\Geometry\Point($longitude, $latitude));

        return $point;
    }
}
