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
     * @return \CrEOF\Spatial\PHP\Types\Geometry\Point
     */
    public function getPoint();

    /**
     * Sets the point.
     *
     * @param \CrEOF\Spatial\PHP\Types\Geometry\Point $point
     */
    public function setPoint(\CrEOF\Spatial\PHP\Types\Geometry\Point $point);
}