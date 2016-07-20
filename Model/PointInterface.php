<?php

namespace Openpp\MapBundle\Model;

/**
 *
 * @author shiroko@webware.co.jp
 *
 */
interface PointInterface
{
    /**
     * Returns the point.
     *
     * @return Point
     */
    public function getPoint();

    /**
     * Sets the point.
     *
     * @param Point $point
     */
    public function setPoint(\CrEOF\Spatial\PHP\Types\Geometry\Point $point);
}