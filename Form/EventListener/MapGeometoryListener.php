<?php

namespace Openpp\MapBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Openpp\MapBundle\Form\DataTransformer\GeometryToStringTransformer;

/**
 * 
 * @author shiroko@webware.co.jp
 *
 */
class MapGeometoryListener implements EventSubscriberInterface
{
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

    public function onPreSetData(FormEvent $event)
    {
        $data = $event->getData();

        if (empty($data)) {
            return;
        }

        $event->setData(array('geometry' => $data));
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

        $event->setData($data['geometry']);
    }
}