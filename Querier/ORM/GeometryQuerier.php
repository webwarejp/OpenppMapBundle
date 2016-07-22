<?php

namespace Openpp\MapBundle\Querier\ORM;

use Doctrine\ORM\EntityManager;
use Openpp\MapBundle\Form\DataTransformer\GeometryToStringTransformer;
use Application\Openpp\MapBundle\Entity\Circle;
use Doctrine\ORM\Query\ResultSetMapping;
use Openpp\MapBundle\Model\PointInterface;

class GeometryQuerier
{
    /**
     * @var EntityManager
     */
    protected $enityManager;

    /**
     * @var \Symfony\Component\Form\DataTransformerInterface
     */
    protected $transformer;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->enityManager = $entityManager;
        $this->transformer  = new GeometryToStringTransformer();
    }

    /**
     *
     * @param mixed $point
     * @param Circle $circle
     * @throws \InvalidArgumentException
     *
     * @return boolean
     */
    public function isPointInCircle($point, Circle $circle)
    {
        if ($point instanceof PointInterface) {
            $point = $point->getPoint();
        } else if (! $point instanceof \CrEOF\Spatial\PHP\Types\Geometry\Point) {
            throw new \InvalidArgumentException('Invalid point type.');
        }

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('result', 'result');

        $sql = 'SELECT ST_DWithin(ST_GeographyFromText(?), ST_GeographyFromText(?), ?) AS result';
        $query = $this->enityManager->createNativeQuery($sql, $rsm);

        $params = array();
        $params[] = $this->transformer->transform($point);
        $params[] = $this->transformer->transform($circle->getCenter());
        $params[] = $circle->getRadius();
        $key = 0;
        foreach ($params as $param) {
            $query->setParameter(++$key, $param);
        }

        return $query->getSingleScalarResult();
    }
}