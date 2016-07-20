<?php

namespace Openpp\MapBundle\Entity;

use Openpp\MapBundle\Model\Point;

/**
 *
 * @author shiroko@webware.co.jp
 *
 */
abstract class BasePoint extends Point
{
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }

    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime);
    }
}