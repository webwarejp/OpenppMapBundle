<?php

namespace Openpp\MapBundle\Entity;

use Openpp\MapBundle\Model\Circle;

abstract class BaseCircle extends Circle
{
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }
}
