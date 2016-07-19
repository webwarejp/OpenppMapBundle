<?php

namespace Openpp\MapBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use CrEOF\Spatial\PHP\Types\Geometry\Polygon;
use CrEOF\Spatial\PHP\Types\Geometry\LineString;
use CrEOF\Spatial\PHP\Types\Geometry\MultiPoint;
use CrEOF\Spatial\PHP\Types\Geometry\MultiLineString;
use CrEOF\Spatial\PHP\Types\Geometry\MultiPolygon;
use CrEOF\Spatial\Exception\InvalidValueException;

/**
 * 
 * @author shiroko@webware.co.jp
 *
 */
class GeometryToJsonTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($geometry)
    {
        if (null === $geometry) {
            return "";
        }

        return $geometry->toJson();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($string)
    {
        if (null === $string || "" === $string) {
            return null;
        }

        $geoArray = json_decode($string, true);

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

            case 'MultiPolygon':
                return new MultiPolygon($geoArray['coordinates']);

            default:
                throw InvalidValueException($geoArray['type']);
        }
    }
}
