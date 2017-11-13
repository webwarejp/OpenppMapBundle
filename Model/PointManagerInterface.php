<?php

namespace Openpp\MapBundle\Model;

interface PointManagerInterface
{
    /**
     * Returns the point's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Returns an empty point instance.
     *
     * @return PointInterface
     */
    public function create();

    /**
     * Returns a point instance which has specified point.
     *
     * @param float $longitude
     * @param float $latitude
     *
     * @return PointInterface
     */
    public function createFromLonLat($longitude, $latitude);
}
