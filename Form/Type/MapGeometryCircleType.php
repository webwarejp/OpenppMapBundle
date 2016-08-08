<?php

namespace Openpp\MapBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Openpp\MapBundle\Form\EventListener\MapGeometoryCircleListener;

/**
 * 
 * @author shiroko@webware.co.jp
 *
 */
class MapGeometryCircleType extends AbstractMapGeometryType implements ContainerAwareInterface
{
    protected $containter;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->containter = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', 'text', array(
                'label' => 'form.center_address',
                'translation_domain' => 'OpenppMapBundle',
                'mapped' => false,
            ))
            ->add('center', 'hidden', array(
                'label' => false,
            ))
            ->add('radius', 'integer', array(
                'label' => 'form.circle_radius',
                'translation_domain' => 'OpenppMapBundle',
                'attr' => array(
                    'min' => 0,
                    'step' => 10,
                ),
            ))
            ->addEventSubscriber(new MapGeometoryCircleListener(
                $this->containter->getParameter('openpp.map.circle.class')
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'openpp_type_map_geometry_circle';
    }
}