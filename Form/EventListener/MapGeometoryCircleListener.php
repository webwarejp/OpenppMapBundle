<?php

namespace Openpp\MapBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\DataTransformerInterface;
use Openpp\MapBundle\Form\DataTransformer\GeometryToJsonTransformer;

/**
 * 
 * @author shiroko@webware.co.jp
 *
 */
class MapGeometoryCircleListener implements EventSubscriberInterface
{
    protected $circleClass;
    protected $transformer;

    /**
     * Constructor
     *
     * @param string                   $circleClass
     * @param DataTransformerInterface $transformer
     */
    public function __construct($circleClass, DataTransformerInterface $transformer = null)
    {
        $this->circleClass = $circleClass;
        $this->transformer = $transformer ? $transformer : new GeometryToJsonTransformer();
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::SUBMIT       => 'onSubmit',
        );
    }

    /**
     * 
     * @param FormEvent $event
     */
    public function onPreSetData(FormEvent $event)
    {
        $data = $event->getData();

        if (empty($data)) {
            return;
        }

        $event->setData(array(
            'address' => null,
            'center' => $this->transformer->transform($data->getCenter()),
            'radius' => $data->getRadius()
        ));
    }

    /**
     * 
     * @param FormEvent $event
     */
    public function onSubmit(FormEvent $event)
    {
        $data = $event->getData();

        if (empty($data)) {
            return;
        }

        $circle = null;
        if (!empty($data['center']) && !empty($data['radius'])) {
            $circleClass = $this->circleClass;
            $circle = new $circleClass;
            $circle->setCenter($this->transformer->reverseTransform($data['center']));
            $circle->setRadius($data['radius']);
        }

        $event->setData($circle);
    }
}