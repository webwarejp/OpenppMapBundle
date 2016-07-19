<?php

namespace Openpp\MapBundle\Model;

use CrEOF\Spatial\PHP\Types\Geometry\GeometryInterface;

/**
 *
 * @author shiroko@webware.co.jp
 *
 */
class Circle implements CircleInterface
{
    /**
     * @var \CrEOF\Spatial\PHP\Types\Geometry\GeometryInterface
     */
    protected $center;

    /**
     * @var integer
     */
    protected $radius;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * {@inheritdoc}
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * {@inheritdoc}
     */
    public function setCenter(GeometryInterface $center)
    {
        $this->center = $center;
    }

    /**
     * {@inheritdoc}
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * {@inheritdoc}
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * Returns the creation date.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the creation date.
     *
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Returns the last update date.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Sets the last update date.
     *
     * @param \DateTime|null $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }
}