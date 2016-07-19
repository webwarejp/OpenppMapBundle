<?php

namespace Openpp\MapBundle\Model;

use CrEOF\Spatial\PHP\Types\Geometry\GeometryInterface;

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
     * @return GeometryInterface
     */
    public function getCenter();

    /**
     * Sets the center of circle.
     *
     * @param GeometryInterface $center
     */
    public function setCenter(GeometryInterface $center);

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