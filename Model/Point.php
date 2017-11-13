<?php

namespace Openpp\MapBundle\Model;

class Point implements PointInterface
{
    /**
     * @var \CrEOF\Spatial\PHP\Types\Geometry\Point
     */
    protected $point;

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
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * {@inheritdoc}
     */
    public function setPoint(\CrEOF\Spatial\PHP\Types\Geometry\Point $point)
    {
        $this->point = $point;
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
