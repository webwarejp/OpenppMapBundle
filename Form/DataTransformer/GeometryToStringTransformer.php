<?php

namespace Openpp\MapBundle\Form\DataTramsformer;

use Symfony\Component\Form\DataTransformerInterface;
use CrEOF\Spatial\PHP\Types\Geometry\GeometryInterface;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use CrEOF\Spatial\PHP\Types\Geometry\Polygon;
use CrEOF\Spatial\PHP\Types\Geometry\LineString;
use CrEOF\Spatial\PHP\Types\Geometry\MultiPoint;
use CrEOF\Spatial\PHP\Types\Geometry\MultiLineString;
use Sonata\Cache\Exception\UnsupportedException;
use CrEOF\Spatial\Exception\InvalidValueException;

/**
 * 
 * @author shiroko@webware.co.jp
 *
 */
class GeometryToStringTransformer extends DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform(GeometryInterface $geometry)
    {
        if (null === $geometry) {
            return "";
        }

        $geoArray = array(
            'type' => $geometry->getType(),
            'coordinates' => $geometry->toArray()
        );

        return json_encode($geoArray);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($string)
    {
        if (null === $string || "" === $string) {
            return null;
        }

        $geoArray = json_decode($string);

        switch ($geoArray['type']) {
            case 'Point':
                return new Point($geoArray['coordinates']);

            case 'Polygon':
                return new Polygon($geoArray['coordinates']);

            case 'LineString':
                return new LineString($geoArray['coordinates']);
            
            case 'MultiPoint':
                return new MultiPoint($geoArray['coordinates']);

            case 'MultiLineString':
                return new MultiLineString($geoArray['coordinates']);

            default:
                throw InvalidValueException::unsupportedWktType($geoArray['type']);
        }

        return null;
    }
}