<?php

namespace Openpp\MapBundle\Model;


/**
 * 
 * @author shiroko@webware.co.jp
 *
 */
interface CircleInterface
{
    /**
     * Returns the center of circle.
     *
     * @return \CrEOF\Spatial\PHP\Types\Geometry\Point
     */
    public function getCenter();

    /**
     * Sets the center of circle.
     *
     * @param \CrEOF\Spatial\PHP\Types\Geometry\Point $center
     */
    public function setCenter(\CrEOF\Spatial\PHP\Types\Geometry\Point $center);

    /**
     * Returns the radius of circle.
     *
     * @return integer
     */
    public function getRadius();

    /**
     * Sets the radius of circle.
     *
     * @param integer $radius
     */
    public function setRadius($radius);
}