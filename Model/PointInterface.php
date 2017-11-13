<?php

namespace Openpp\MapBundle\Model;

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
