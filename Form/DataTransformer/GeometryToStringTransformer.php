<?php

namespace Openpp\MapBundle\Form\DataTransformer;

use CrEOF\Geo\WKT\Parser;
use Symfony\Component\Form\DataTransformerInterface;

class GeometryToStringTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($geometry)
    {
        if (null === $geometry) {
            return '';
        }

        return strtoupper($geometry->getType()).'('.$geometry->__toString().')';
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($string)
    {
        if (null === $string || '' === $string) {
            return null;
        }

        $parser = new Parser($string);

        return $parser->parse();
    }
}
