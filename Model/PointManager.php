<?php

namespace Openpp\MapBundle\Model;

abstract class PointManager implements PointManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $class = $this->getClass();
        $tag = new $class();

        return $tag;
    }
}
